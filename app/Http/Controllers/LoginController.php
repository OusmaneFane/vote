<?php

namespace App\Http\Controllers;

use PDO;
use Exception;
use App\Models\Vote;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Classe;
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
        $classes = Classe::all();
        $candidats = Candidat::all();

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view('/posts.inscrit', ['actel_user'=>$actel_user, 'classes'=> $classes]);
    }
    public function trait(Request $request)
     {
        request()->validate([
            'matricule' => ['required'],
            'password' => ['required'],
            'classe_id' => ['required'],

        ]);

         $query = DB::table('students')
                ->insert([
                    'matricule' => $request->matricule,
                    'password' => $request->password,
                    'classe_id' => $request->classe_id
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
