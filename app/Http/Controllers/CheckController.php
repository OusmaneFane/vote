<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vote;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class CheckController extends Controller
{
public function check(Request $request)
{
    $request->validate([
        'matricule' => ['required'],
        'password' => ['required'],
    ]);
     $student = DB::table('students')
        ->where('matricule', $request->matricule)
        ->first();
if (!$student) {
        return back()->with('fail', 'Ce matricule n\'est pas autorisé pour voter');
    }
    // Vérifier si l'étudiant a déjà voté
    $hasVoted = DB::table('votes')
         ->where('user_id', '=', $student->id)
        ->count();

    if ($hasVoted > 0) {
        return back()->with('fail', 'Vous avez déjà voté');
    }

    // Vérifier si le matricule existe dans la base de données locale
   

    

    // Faire la requête à l'API externe pour vérifier le mot de passe
    $apiResponse = Http::withHeaders([
        'accept' => '*/*',
        'Content-Type' => 'application/json',
    ])->post('https://api-staging.supmanagement.ml/auth/login', [
        'username' => $request->matricule,
        'password' => $request->password,
        'rememberMe' => true,
    ]);
    $data = $apiResponse->json(); 
    //dd($data['message']) ;
    if($data['message'] == 'Invalid credentials'){
           return back()->with('fail', 'Mot de passe incorrect');
    }
    if ($apiResponse->successful()) {
        $token = $apiResponse->body();
        $request->session()->put('jwt_token', $token);

        // Enregistrement de l'adresse IP
        DB::table('addresses')->insert([
            'user_id' => $student->id,
            'ip_address' => $request->ip(),
        ]);

        $request->session()->put('PasseUser', $student->id);

        return redirect('/posts/form');
    } else {


        return back()->with('fail', 'Échec de l\'authentification avec l\'API externe: ' );
    }
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
