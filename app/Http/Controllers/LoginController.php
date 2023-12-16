<?php

namespace App\Http\Controllers;

use PDO;
use Exception;
use App\Models\Vote;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function board(){
        return view('board');
    }


    public function inscription(Request $request)
    {
        $oumou = Vote::where('candidat_id', '1')->count();
        $oumou2=  $oumou * 20;
        $kaba =  Vote::where('candidat_id', '2')->count();
        $kaba2=  $kaba * 20;
        $junior = Vote::where('candidat_id', '3')->count();
        $junior2 = $junior * 20;
        $abg = Vote::where('candidat_id', '4')->count();
        $abg2 = $abg *20;
        $diata = Vote::where('candidat_id', '5')->count();
        $diata2 = $diata * 20;
        $luciane = Vote::where('candidat_id', '6')->count();
        $luciane2 = $luciane * 20;
        $oumar = Vote::where('candidat_id', '7')->count();
        $oumar2 = $oumar * 20;
        $vote_nul = Vote::where('candidat_id', '8')->count();
        $vote_nul2 = $vote_nul * 20;
        $som =  ($oumou +  $kaba +  $junior + $abg +  $diata +  $luciane +  $oumar);
        $candidats = Candidat::all();

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view('/posts.inscrit', ['actel_user'=>$actel_user, 'oumou'=>$oumou, 'kaba'=>$kaba, 'junior'=>$junior,
        'abg'=>$abg, 'diata'=>$diata, 'luciane'=>$luciane, 'oumar'=>$oumar,
        'oumou2'=>$oumou2, 'kaba2'=>$kaba2, 'junior2'=>$junior2, 'abg2'=>$abg2,
        'diata2'=>$diata2, 'luciane2'=>$luciane2, 'oumar2'=>$oumar2, 'candidats'=>$candidats,
        'som'=>$som, 'vote_nul'=>$vote_nul, 'vote_nul2'=>$vote_nul2]);
    }
    public function trait(Request $request)
     {
        request()->validate([
            'matricule' => ['required'],
            'password' => ['required'],

        ]);

         $query = DB::table('students')
                ->insert([
                    'matricule' => $request->matricule,
                    'password' => $request->password,
                ]);

        if($query){
            return back()->with('success', 'Inscription réussi avec succès');
        }else {
            return back()->with('fail', 'Quelque chose s\'est mal passée');
        }

     }

    public function form(Request $request){
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Student::find($PasseUser);
        $candidats = Candidat::all();
       // dd($candidats);
        return view('posts.form', ['candidats'=>$candidats, 'actel_user'=>$actel_user]);
    }
    public function login(){
        return view('posts.login');
    }
    public function logout()
    {
        if(session()->has('PasseUser')){
            session()->pull('PasseUser');
            return redirect('/');
        }else{
            return redirect('/');
        }
    }
}
