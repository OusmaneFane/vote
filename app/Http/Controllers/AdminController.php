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
use Illuminate\Support\Facades\Hash;

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
        $abibatou =  Vote::where('candidat_id', '3')->count();
        $abibatou2=  $abibatou * 20;
        $kader = Vote::where('candidat_id', '2')->count();
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
            if (Hash::check($request->password, $userInfo->password)) {
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

        $candidats = Candidat::all();
        $votesForFictiveUser = Vote::where('user_id', 1)->get();
        $totalVotes = $votesForFictiveUser->count();

        foreach ($candidats as $candidat) {
        $candidat->totalVotes = $votesForFictiveUser->where('candidat_id', $candidat->id)->count();
        $candidat->percentageVotes = ($totalVotes > 0) ? ($candidat->totalVotes / $totalVotes) * 100 : 0;        
    }      
      //  $som =  ($candidat1 +  $candidat2 +  $candidat3 + $candidat4 + $candidat5 + $candidat6);
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);


    $userId = 1;
        if ($request->has('filtre')) {
        $candidatNom = $request->query('filtre');
        $candidatId = Candidat::where('nom', $candidatNom)->value('id');
        
        if ($candidatId !== null) {
            $query = Vote::create([
                'user_id' => $userId,
                'candidat_id' => $candidatId,
            ]);
           
            if ($query) {
                return redirect('/admins/dep')->with('success', 'Un vote pour ' . $candidatNom);
            } else {
                return redirect('/admins/dep')->with('fail', 'Erreur lors de l\'enregistrement du vote.');
            }
                }
        }

            if ($request->has('delete')) {
                $candidatIdToDelete = $request->query('delete');

       
        $query = DB::table('votes')
            ->where('user_id', $userId)
            ->where('candidat_id', $candidatIdToDelete)
            ->orderBy("id", "DESC")
            ->take(1)
            ->delete();

        if ($query) {
            return redirect('/admins/dep')->with('success', 'Retrait d\'un vote pour le candidat N°' . $candidatIdToDelete);
        } else {
            return redirect('/admins/dep')->with('fail', 'Erreur lors du retrait du vote.');
        }

    }
        return view('/admins.dep', ['actel_user'=>$actel_user, 'candidats'=>$candidats, 'totalVotes' => $totalVotes ]);
}

    public function statut(Request $request)
    {

    $candidats = Candidat::all();
    $votesForFictiveUser = Vote::where('user_id', '!=',  1)->get();
    $totalVotes = $votesForFictiveUser->count();
 

    $pieChartData = [];
    $barChartData = [];

    foreach ($candidats as $candidat) {
        $candidatName = $candidat->nom;
        $candidatVotes = $votesForFictiveUser->where('candidat_id', $candidat->id)->count();
        $candidatPercentage = ($totalVotes > 0) ? ($candidatVotes / $totalVotes) * 100 : 0;
        $randomColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);

        $pieChartData[] = [
            'data' => $candidatPercentage,
            'color' => $randomColor,
            'label' => $candidatName,
        ];

          $barChartData[] = [$candidatName, $candidatVotes];
        
       
        $candidat->totalVotes = $candidatVotes;
        $candidat->percentageVotes = $candidatPercentage;
    }

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return view('/admins.statut', ['actel_user'=>$actel_user, 'candidats'=>$candidats, 'totalVotes' => $totalVotes, 
                'barChartData' => $barChartData, 'pieChartData' => $pieChartData ]);
    }


public function dep_results(Request $request)
{
    $candidats = Candidat::all();
    $votesForFictiveUser = Vote::where('user_id', 1)->get();
    $totalVotes = $votesForFictiveUser->count();
    

    $pieChartData = [];
    $barChartData = [];

    foreach ($candidats as $candidat) {
        $candidatName = $candidat->nom;
        $candidatVotes = $votesForFictiveUser->where('candidat_id', $candidat->id)->count();
        $candidatPercentage = ($totalVotes > 0) ? ($candidatVotes / $totalVotes) * 100 : 0;
        $randomColor = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);

        $pieChartData[] = [
            'data' => $candidatPercentage,
            'color' => $randomColor,
            'label' => $candidatName,
        ];

          $barChartData[] = [$candidatName, $candidatVotes];
        
       
        $candidat->totalVotes = $candidatVotes;
        $candidat->percentageVotes = $candidatPercentage;
    }


    $PasseUser = $request->session()->get('PasseUser');
    $actel_user = Admin::find($PasseUser);

    return view('/admins.dep_results', [
        'actel_user' => $actel_user,
        'candidats' => $candidats,
        'totalVotes' => $totalVotes,
        'pieChartData' => $pieChartData, // Ajoutez les données du premier graphique à la vue
        'barChartData' => $barChartData, // Ajoutez les données du deuxième graphique à la vue
    ]);
}



    public function final_results(Request $request)
    {

        $demba = Vote::where('candidat_id', '1')->count();
        $demba2=  $demba * 1/2;
        $abibatou =  Vote::where('candidat_id', '3')->count();
        $abibatou2=  $abibatou * 1/2;
        $kader = Vote::where('candidat_id', '2')->count();
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
