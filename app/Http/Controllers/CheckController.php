<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vote;

class CheckController extends Controller
{
    public function check( Request $request)
    {

        request()->validate([
            'matricule' => ['required'],
            'password' => ['required'],
        ]);

        $userInfo = DB::table('students')
                  ->where('matricule', $request->matricule )
                  ->first();
                 if(!$userInfo) {
                    return back()->with('fail', 'Ce matricule n\'existe pas');
                }



         $exist = DB::table('votes')
                  ->where('user_id', '=',$userInfo->id)
                  ->count();

        if($userInfo){
            if($request->password == $userInfo->password){

                if($exist > 0){
                    return back()->with('fail', 'Ce matricule a déjà voté');

                }else{
                    $request->session()->put('PasseUser', $userInfo->id);
                    $matricule = $userInfo->id;
                    $PasseUser = $request->session()->get('PasseUser');
                    $actel_user = Student::find($PasseUser);

                    $query = DB::table('addresses')
                    ->insert([
                        'user_id' => $actel_user->id,
                        'ip_address' => $userInfo->ip = request()->ip(),
                   ]);
                    return redirect('/posts/form');
                }
            }else{

                return back()->with('fail', 'Mot de passe Incorrect');
            }
        }else{

            return back()->with('fail', 'Ce matricule n\'existe pas');
         }
        // $PasseUser = $request->session()->get('PasseUser');
        // $actel_user = Student::find($PasseUser);


        //  $matricule = $actel_user->matricule;

    }

    public function valide(Request $request){
        request()->validate([
            'candidat_id' => ['required'],

        ]);
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Student::find($PasseUser);
        if(!($actel_user)){
            return back()->with('fail', 'une erreur s\'est produite');

        }
        $matricule = $actel_user->matricule;

            if (Student::find($actel_user->id)) {
        $query = Vote::create([
            'user_id' => $actel_user->id,
            'candidat_id' => $request->candidat_id,
        ]);

        if ($query) {
            session()->pull('PasseUser');
            return redirect('/')->with('success', 'Vote enregistré avec succès');
        } else {
            return back()->with('fail', 'Une erreur s\'est produite lors de l\'enregistrement du vote');
        }
    } else {
        return back()->with('fail', 'L\'utilisateur n\'existe pas');
    }
    }
}
