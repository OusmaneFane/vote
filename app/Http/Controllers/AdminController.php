<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Candidat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function AdminCheck(Request $request)
    {
      return view ('admins.login');
}
    public function administrator(Request $request)
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
        $votes = Vote::all();

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view ('/admins/dashboard', ['actel_user'=>$actel_user, 'oumou'=>$oumou, 'kaba'=>$kaba, 'junior'=>$junior,
                                           'abg'=>$abg, 'diata'=>$diata, 'luciane'=>$luciane, 'oumar'=>$oumar,
                                           'oumou2'=>$oumou2, 'kaba2'=>$kaba2, 'junior2'=>$junior2, 'abg2'=>$abg2,
                                           'diata2'=>$diata2, 'luciane2'=>$luciane2, 'oumar2'=>$oumar2, 'candidats'=>$candidats,
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
        $votes = Vote::all();
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);


        if( $request->has('filtre'))
        {
            if($request->query('filtre') == 'OUMOU KEITA'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '1',
                ]);
               }
            else if($request->query('filtre') == 'MOUSSA KABA'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '2',]);
            }
            else if($request->query('filtre') == 'MOHAMED JUNIOR NIMAGA'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '3',]);
            }
            else if($request->query('filtre') == 'ABOUBACAR GOUNDOUROU'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '4',]);
            }
            else if($request->query('filtre') == 'DIATA TRAORE'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '5',]);
            }
            else if($request->query('filtre') == 'LUCIANE INISSE DOLO'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '6',]);
            }
            else if($request->query('filtre') == 'OUMAR FOFANA'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '7',]);
            }
            else if($request->query('filtre') == 'VOTE NUL'){
                $query = DB::table('votes')
                ->insert([
                    'user_id' => '0',
                    'candidat_id' => '8',]);
            }


        }


        if($request->query('filtre')){
            return redirect('/admins/dep');
        }
        if($request->has('delete')){
            $query = DB::table('votes')
                    ->where('user_id', '0')
                    ->where('candidat_id', $request->query('delete'))
                    ->orderBy("id", "DESC")
                    ->take(1)
                    ->delete();
         return redirect('/admins/dep');

        }

        return view('/admins.dep', ['actel_user'=>$actel_user, 'oumou'=>$oumou, 'kaba'=>$kaba, 'junior'=>$junior,
        'abg'=>$abg, 'diata'=>$diata, 'luciane'=>$luciane, 'oumar'=>$oumar,
        'oumou2'=>$oumou2, 'kaba2'=>$kaba2, 'junior2'=>$junior2, 'abg2'=>$abg2,
        'diata2'=>$diata2, 'luciane2'=>$luciane2, 'oumar2'=>$oumar2, 'candidats'=>$candidats, 'votes'=>$votes,
        'som'=>$som, 'vote_nul'=>$vote_nul, 'vote_nul2'=>$vote_nul2]);
    }

    public function statut(Request $request)
    {

        $oumou = Vote::where('candidat_id', '1')
                        ->where('user_id', '!=', '0')
                        ->count();
        $oumou2=  $oumou * 6;
        $kaba =  Vote::where('candidat_id', '2')
                        ->where('user_id', '!=', '0')
                        ->count();
        $kaba2=  $kaba * 6;
        $junior = Vote::where('candidat_id', '3')
                        ->where('user_id', '!=', '0')
                        ->count();
        $junior2 = $junior * 6;
        $abg = Vote::where('candidat_id', '4')
                        ->where('user_id', '!=', '0')
                        ->count();
        $abg2 = $abg *6;
        $diata = Vote::where('candidat_id', '5')
                        ->where('user_id', '!=', '0')
                        ->count();
        $diata2 = $diata * 6;
        $luciane = Vote::where('candidat_id', '6')
                        ->where('user_id', '!=', '0')
                        ->count();
        $luciane2 = $luciane * 6;
        $oumar = Vote::where('candidat_id', '7')
                        ->where('user_id', '!=', '0')
                        ->count();
        $oumar2 = $oumar * 6;
        $vote_nul = Vote::where('candidat_id', '8')
                        ->where('user_id', '!=', '0')
                        ->count();
        $vote_nul2 = $vote_nul * 6;
        $som =  ($oumou +  $kaba +  $junior + $abg +  $diata +  $luciane +  $oumar);
        $candidats = Candidat::all();

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view('/admins.statut', ['actel_user'=>$actel_user, 'oumou'=>$oumou, 'kaba'=>$kaba, 'junior'=>$junior,
        'abg'=>$abg, 'diata'=>$diata, 'luciane'=>$luciane, 'oumar'=>$oumar,
        'oumou2'=>$oumou2, 'kaba2'=>$kaba2, 'junior2'=>$junior2, 'abg2'=>$abg2,
        'diata2'=>$diata2, 'luciane2'=>$luciane2, 'oumar2'=>$oumar2, 'candidats'=>$candidats,
        'som'=>$som, 'vote_nul'=>$vote_nul, 'vote_nul2'=>$vote_nul2]);
    }


    public function dep_results(Request $request)
    {

        $oumou_dec = Vote::where('candidat_id', '1')
                       ->where('user_id', '0')
                       ->count();
        $oumou2=  $oumou_dec * 6;
        $kaba_dec =  Vote::where('candidat_id', '2')
                        ->where('user_id', '0')
                        ->count();
        $kaba2=  $kaba_dec * 6;
        $junior_dec = Vote::where('candidat_id', '3')
                        ->where('user_id', '0')
                        ->count();
        $junior2 = $junior_dec * 6;
        $abg_dec = Vote::where('candidat_id', '4')
                        ->where('user_id', '0')
                        ->count();
        $abg2 = $abg_dec *6;
        $diata_dec = Vote::where('candidat_id', '5')
                        ->where('user_id', '0')
                        ->count();
        $diata2 = $diata_dec * 6;
        $luciane_dec = Vote::where('candidat_id', '6')
                        ->where('user_id', '0')
                        ->count();
        $luciane2 = $luciane_dec * 6;
        $oumar_dec = Vote::where('candidat_id', '7')
                        ->where('user_id', '0')
                        ->count();
        $oumar2 = $oumar_dec * 6;
        $vote_nul_dec = Vote::where('candidat_id', '8')
                        ->where('user_id', '0')
                        ->count();
        $vote_nul2 = $vote_nul_dec * 6;
        $som =  ($oumou_dec +  $kaba_dec +  $junior_dec + $abg_dec +  $diata_dec +  $luciane_dec +  $oumar_dec);
        $candidats = Candidat::all();

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view('/admins.dep_results', ['actel_user'=>$actel_user, 'oumou_dec'=>$oumou_dec, 'kaba_dec'=>$kaba_dec, 'junior_dec'=>$junior_dec,
        'abg_dec'=>$abg_dec, 'diata_dec'=>$diata_dec, 'luciane_dec'=>$luciane_dec, 'oumar_dec'=>$oumar_dec,
        'oumou2'=>$oumou2, 'kaba2'=>$kaba2, 'junior2'=>$junior2, 'abg2'=>$abg2,
        'diata2'=>$diata2, 'luciane2'=>$luciane2, 'oumar2'=>$oumar2, 'candidats'=>$candidats,
        'som'=>$som, 'vote_nul_dec'=>$vote_nul_dec, 'vote_nul2'=>$vote_nul2]);
    }

    public function final_results(Request $request)
    {

        $oumou = Vote::where('candidat_id', '1')->count();
        $oumou2=  $oumou * 6;
        $kaba =  Vote::where('candidat_id', '2')->count();
        $kaba2=  $kaba * 6;
        $junior = Vote::where('candidat_id', '3')->count();
        $junior2 = $junior * 6;
        $abg = Vote::where('candidat_id', '4')->count();
        $abg2 = $abg *6;
        $diata = Vote::where('candidat_id', '5')->count();
        $diata2 = $diata * 6;
        $luciane = Vote::where('candidat_id', '6')->count();
        $luciane2 = $luciane * 6;
        $oumar = Vote::where('candidat_id', '7')->count();
        $oumar2 = $oumar * 6;
        $vote_nul = Vote::where('candidat_id', '8')->count();
        $vote_nul2 = $vote_nul * 6;
        $som =  ($oumou +  $kaba +  $junior + $abg +  $diata +  $luciane +  $oumar);
        $candidats = Candidat::all();


        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view ('/admins/final_results', ['actel_user'=>$actel_user, 'oumou'=>$oumou, 'kaba'=>$kaba, 'junior'=>$junior,
                                           'abg'=>$abg, 'diata'=>$diata, 'luciane'=>$luciane, 'oumar'=>$oumar,
                                           'oumou2'=>$oumou2, 'kaba2'=>$kaba2, 'junior2'=>$junior2, 'abg2'=>$abg2,
                                           'diata2'=>$diata2, 'luciane2'=>$luciane2, 'oumar2'=>$oumar2, 'candidats'=>$candidats,
                                           'som'=>$som, 'vote_nul'=>$vote_nul, 'vote_nul2'=>$vote_nul2]);

    }


}
