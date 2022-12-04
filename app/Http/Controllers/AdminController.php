<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function AdminCheck(Request $request)
    {
      return view ('admins.login');
}
    public function administrator(Request $request)
    {

        $demba = Vote::where('candidat_id', '1')->count();
        $demba2=  $demba * 20;
        $abibatou =  Vote::where('candidat_id', '2')->count();
        $abibatou2=  $abibatou * 20;
        $kader = Vote::where('candidat_id', '3')->count();
        $kader2 = $kader * 20;

        $vote_nul = Vote::where('candidat_id', '5')->count();
        $vote_nul2 = $vote_nul * 20;
        $som =  ($demba +  $abibatou +  $kader);
        $candidats = Candidat::all();
        $votes = Vote::all();

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view ('/admins/dashboard', ['actel_user'=>$actel_user, 'demba'=>$demba, 'abibatou'=>$abibatou, 'kader'=>$kader,
                                           'demba2'=>$demba2, 'abibatou2'=>$abibatou2, 'kader2'=>$kader2, 'candidats'=>$candidats,
                                           'som'=>$som, 'vote_nul'=>$vote_nul, 'vote_nul2'=>$vote_nul2]);

    }
    public function check(Request $request)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);

        request()->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);

        $userInfo = DB::table('admins')
                  ->where('name', $request->name )
                  ->first();


        if($userInfo){
            if($request->password == $userInfo->password){
                $request->session()->put('PasseUser', $userInfo->id);
                if($userInfo->user_type== 'Administrator'){
                    return redirect('/admins/statut');
                }
                else{
                    return redirect('/');
                }

            }else{
                return back()->with('fail', 'Mot de passe Incorrect');
            }
        }else{
                return back()->with('fail', 'Ce compte n\'existe pas');
        }
    }

    public function dep(Request $request)
    {


        $oumou = Vote::where('candidat_id', '1')->count();
        $oumou2=  $oumou * 20;
        $kaba =  Vote::where('candidat_id', '2')->count();
        $kaba2=  $kaba * 20;
        $junior = Vote::where('candidat_id', '3')->count();
        $junior2 = $junior * 20;

        $vote_nul = Vote::where('candidat_id', '5')->count();
        $vote_nul2 = $vote_nul * 20;
        $som =  ($oumou +  $kaba +  $junior);
        $candidats = Candidat::all();
        $votes = Vote::all();
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        $demba = Vote::where('candidat_id', '1')->count();
        $demba2=  $demba * 6;
        $abibatou =  Vote::where('candidat_id', '2')->count();
        $abibatou2=  $abibatou * 6;
        $kader = Vote::where('candidat_id', '3')->count();
        $kader2 = $kader * 6;
        $vote_nul = Vote::where('candidat_id', '5')->count();
        $vote_nul2 = $vote_nul *6;


        if( $request->has('filtre'))
        {
            if($request->query('filtre') == 'DEMBA TOUNKARA'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '1',
                ]);
               }
            else if($request->query('filtre') == 'ABIBATOU TRAORE'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '2',]);
            }
            else if($request->query('filtre') == 'ABDOUL KADER DOUCOURE'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '3',]);
            }
            else if($request->query('filtre') == 'VOTE NUL'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '5',]);
            }



        }


        if($request->query('filtre')){
            return redirect('/admins/dep')->with('success', 'Un vote pour '.$request->query('filtre'));
        }
        if($request->has('delete')){
            $query = DB::table('votes')
                    ->where('user_id', '0')
                    ->where('candidat_id', $request->query('delete'))
                    ->orderBy("id", "DESC")
                    ->take(1)
                    ->delete();
         return redirect('/admins/dep')->with('fail', 'Retrait d\'un vote pour le candidat N°'.$request->query('delete') );

        }

        return view('/admins.dep', ['actel_user'=>$actel_user, 'oumou'=>$oumou, 'kaba'=>$kaba, 'junior'=>$junior,
        'candidats'=>$candidats, 'votes'=>$votes,'som'=>$som, 'vote_nul'=>$vote_nul, 'vote_nul2'=>$vote_nul2,
    'demba'=>$demba, 'demba2'=>$demba2, 'abibatou'=>$abibatou, 'abibatou2'=>$abibatou2,
 'kader'=>$kader, 'kader2'=>$kader2, ]);
    }

    public function statut(Request $request)
    {

        $demba = Vote::where('candidat_id', '1') ->where('user_id', '!=', '0')->count();
        $demba2=  $demba * 20;
        $abibatou =  Vote::where('candidat_id', '2') ->where('user_id', '!=', '0')->count();
        $abibatou2=  $abibatou * 20;
        $kader = Vote::where('candidat_id', '3') ->where('user_id', '!=', '0')->count();
        $kader2 = $kader * 20;
        $vote_nul = Vote::where('candidat_id', '5') ->where('user_id', '!=', '0')->count();
        $vote_nul2 = $vote_nul * 20;
        $som =  ($demba +  $abibatou +  $kader);

        $candidats = Candidat::all();

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view('/admins.statut', ['actel_user'=>$actel_user, 'demba'=>$demba, 'abibatou'=>$abibatou, 'kader'=>$kader,
        'demba2'=>$demba2, 'abibatou2'=>$abibatou2, 'kader2'=>$kader2,'candidats'=>$candidats,
        'som'=>$som, 'vote_nul'=>$vote_nul, 'vote_nul2'=>$vote_nul2]);
    }


    public function dep_results(Request $request)
    {

        $demba_dec = Vote::where('candidat_id', '1')
                       ->where('user_id', '0')
                       ->count();
        $demba2=  $demba_dec * 1/2;
        $abiba_dec =  Vote::where('candidat_id', '2')
                        ->where('user_id', '0')
                        ->count();
        $abiba2=  $abiba_dec * 1/2;
        $kader_dec = Vote::where('candidat_id', '3')
                        ->where('user_id', '0')
                        ->count();
        $kader2 = $kader_dec * 1/2;
        $vote_nul_dec = Vote::where('candidat_id', '5')
                        ->where('user_id', '0')
                        ->count();
        $vote_nul2 = $vote_nul_dec *1/2;


        $vote_nul2 = $vote_nul_dec * 1/2;
        $som =  ($demba_dec +  $abiba_dec +  $kader_dec );
        $candidats = Candidat::all();

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view('/admins.dep_results', ['actel_user'=>$actel_user, 'demba_dec'=>$demba_dec, 'abiba2'=>$abiba2, 'kader_dec'=>$kader_dec,
        'vote_nul_dec'=>$vote_nul_dec, 'demba2'=>$demba2, 'abiba_dec'=>$abiba_dec, 'kader2'=>$kader2, 'vote_nul2'=>$vote_nul2,
        'candidats'=>$candidats,'som'=>$som, ]);
    }

    public function final_results(Request $request)
    {

        $demba = Vote::where('candidat_id', '1')->count();
        $demba2=  $demba * 1/2;
        $abibatou =  Vote::where('candidat_id', '2')->count();
        $abibatou2=  $abibatou * 1/2;
        $kader = Vote::where('candidat_id', '3')->count();
        $kader2 = $kader * 1/2;
        $vote_nul = Vote::where('candidat_id', '5')->count();
        $vote_nul2 = $vote_nul *1/2;

        $som =  ($demba +  $abibatou +  $kader );
        $candidats = Candidat::all();
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view ('/admins/final_results', ['actel_user'=>$actel_user, 'demba'=>$demba, 'abibatou'=>$abibatou, 'kader'=>$kader,
                                           'vote_nul'=>$vote_nul,'demba2'=>$demba2, 'abibatou2'=>$abibatou2, 'kader2'=>$kader2,
                                           'vote_nul2'=>$vote_nul2,'candidats'=>$candidats,'som'=>$som, ]);

    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new StudentImport,request()->file('excel_file'));


        return redirect()->back()->with('success', 'fichier importé avec succès');
    }

    public function file(Request $request){
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);

        return view('/admins/import_file', ['actel_user'=>$actel_user]);
    }


}
