<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Imports\StudentImport;
use App\Imports\ClasseImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use App\Events\VoteUpdated;

class AdminController extends Controller
{
    public function getTotalVotes()
    {
        // Logique pour obtenir le total des votes
        $votesForFictiveUser = Vote::where('user_id', 1)->get();
        return $votesForFictiveUser->count();
    }
    public function AdminCheck(Request $request)
    {
        return view('admins.login');
    }
    public function administrator(Request $request)
    {
        $candidats = Candidat::all();
        $votes = Vote::all();
        $totalVotes = $votes->count();

        $pieChartData = [];
        $barChartData = [];

        foreach ($candidats as $candidat) {
            $candidatName = $candidat->nom;
            $candidatVotes = $votes
                ->where('candidat_id', $candidat->id)
                ->count();
            $candidatPercentage =
                $totalVotes > 0 ? ($candidatVotes / $totalVotes) * 100 : 0;
            $randomColor =
                '#' .
                str_pad(dechex(mt_rand(0, 0xffffff)), 6, '0', STR_PAD_LEFT);

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

        return view('/admins.index', [
            'actel_user' => $actel_user,
            'candidats' => $candidats,
            'totalVotes' => $totalVotes,
            'pieChartData' => $pieChartData, // Ajoutez les données du premier graphique à la vue
            'barChartData' => $barChartData, // Ajoutez les données du deuxième graphique à la vue
        ]);
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
            ->where('name', $request->name)
            ->first();

        if ($userInfo) {
            if (Hash::check($request->password, $userInfo->password)) {
                $request->session()->put('PasseUser', $userInfo->id);
                if ($userInfo->user_type == 'Administrator') {
                    return redirect('/admins/statut');
                } else {
                    return redirect('/');
                }
            } else {
                return back()->with('fail', 'Mot de passe Incorrect');
            }
        } else {
            return back()->with('fail', 'Ce compte n\'existe pas');
        }
    }

    public function dep(Request $request)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);

        $candidats = Candidat::all();
        $votesForFictiveUser = Vote::where('user_id', 1)->get();
        $totalVotes = $votesForFictiveUser->count();

        foreach ($candidats as $candidat) {
            $candidat->totalVotes = $votesForFictiveUser
                ->where('candidat_id', $candidat->id)
                ->count();
            $candidat->percentageVotes =
                $totalVotes > 0
                    ? ($candidat->totalVotes / $totalVotes) * 100
                    : 0;
        }

        $userId = 1;

        if ($request->has('filtre')) {
            $candidatNom = $request->query('filtre');
            $candidatId = Candidat::where('nom', $candidatNom)->value('id');

            if ($candidatId !== null) {
                Vote::create([
                    'user_id' => $userId,
                    'candidat_id' => $candidatId,
                ]);

                event(new VoteUpdated($candidatId));

                return redirect('/admins/dep')->with(
                    'success',
                    'Un vote pour ' . $candidatNom
                );
            } else {
                return redirect('/admins/dep')->with(
                    'fail',
                    'Erreur lors de l\'enregistrement du vote.'
                );
            }
        }

        if ($request->has('delete')) {
            $candidatIdToDelete = $request->query('delete');

            $query = Vote::where('user_id', $userId)
                ->where('candidat_id', $candidatIdToDelete)
                ->orderBy('id', 'DESC')
                ->take(1)
                ->delete();

            if ($query) {
                event(new VoteUpdated($candidatIdToDelete));

                return redirect('/admins/dep')->with(
                    'success',
                    'Retrait d\'un vote pour le candidat N°' .
                        $candidatIdToDelete
                );
            } else {
                return redirect('/admins/dep')->with(
                    'fail',
                    'Erreur lors du retrait du vote.'
                );
            }
        }

        return view('/admins.dep', [
            'candidats' => $candidats,
            'totalVotes' => $totalVotes,
            'actel_user' => $actel_user,
        ]);
    }

    public function statut(Request $request)
    {
        $candidats = Candidat::all();
        $votesForFictiveUser = Vote::where('user_id', '!=', 1)->get();
        $totalVotes = $votesForFictiveUser->count();

        $pieChartData = [];
        $barChartData = [];

        foreach ($candidats as $candidat) {
            $candidatName = $candidat->nom;
            $candidatVotes = $votesForFictiveUser
                ->where('candidat_id', $candidat->id)
                ->count();
            $candidatPercentage =
                $totalVotes > 0 ? ($candidatVotes / $totalVotes) * 100 : 0;
            $randomColor =
                '#' .
                str_pad(dechex(mt_rand(0, 0xffffff)), 6, '0', STR_PAD_LEFT);

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
        return view('/admins.statut', [
            'actel_user' => $actel_user,
            'candidats' => $candidats,
            'totalVotes' => $totalVotes,
            'barChartData' => $barChartData,
            'pieChartData' => $pieChartData,
        ]);
    }

    public function statutData(Request $request)
    {
        $candidats = Candidat::all();
        $votesForFictiveUser = Vote::where('user_id', '!=', 1)->get();
        $totalVotes = $votesForFictiveUser->count();

        $pieChartData = [];
        $barChartData = [];

        foreach ($candidats as $candidat) {
            $candidatName = $candidat->nom;
            $candidatVotes = $votesForFictiveUser
                ->where('candidat_id', $candidat->id)
                ->count();
            $candidatPercentage =
                $totalVotes > 0 ? ($candidatVotes / $totalVotes) * 100 : 0;
            $randomColor =
                '#' .
                str_pad(dechex(mt_rand(0, 0xffffff)), 6, '0', STR_PAD_LEFT);

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
        return [
            'actel_user' => $actel_user,
            'candidats' => $candidats,
            'totalVotes' => $totalVotes,
            'barChartData' => $barChartData,
            'pieChartData' => $pieChartData,
        ];
    }
    public function depData(Request $request)
    {
        $candidats = Candidat::all();
        $votesForFictiveUser = Vote::where('user_id', '=', 1)->get();
        $totalVotes = $votesForFictiveUser->count();

        foreach ($candidats as $candidat) {
            $candidatName = $candidat->nom;
            $candidatVotes = $votesForFictiveUser
                ->where('candidat_id', $candidat->id)
                ->count();
            $candidatPercentage =
                $totalVotes > 0 ? ($candidatVotes / $totalVotes) * 100 : 0;

            $candidat->totalVotes = $candidatVotes;
            $candidat->percentageVotes = $candidatPercentage;
        }

        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);
        return [
            'actel_user' => $actel_user,
            'candidats' => $candidats,
            'totalVotes' => $totalVotes,
        ];
    }

    public function getRealtimeVotes(Request $request)
    {
        // Par exemple, récupérez tous les votes récents dans les dernières minutes
        $recentVotes = Vote::where(
            'created_at',
            '>=',
            now()->subMinutes(5)
        )->get();

        // Calculer le nombre total de votes récents
        $realtimeVotes = $recentVotes->count();

        // Diffuser les mises à jour Pusher
        Broadcast::event('votes-updated', ['realtimeVotes' => $realtimeVotes]);

        return response()->json([
            'success' => true,
            'realtimeVotes' => $realtimeVotes,
        ]);
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
            $candidatVotes = $votesForFictiveUser
                ->where('candidat_id', $candidat->id)
                ->count();
            $candidatPercentage =
                $totalVotes > 0 ? ($candidatVotes / $totalVotes) * 100 : 0;
            $randomColor =
                '#' .
                str_pad(dechex(mt_rand(0, 0xffffff)), 6, '0', STR_PAD_LEFT);

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
        $candidats = Candidat::all();
        $votes = Vote::all();
        $totalVotes = $votes->count();

        $pieChartData = [];
        $barChartData = [];

        foreach ($candidats as $candidat) {
            $candidatName = $candidat->nom;
            $candidatVotes = $votes
                ->where('candidat_id', $candidat->id)
                ->count();
            $candidatPercentage =
                $totalVotes > 0 ? ($candidatVotes / $totalVotes) * 100 : 0;
            $randomColor =
                '#' .
                str_pad(dechex(mt_rand(0, 0xffffff)), 6, '0', STR_PAD_LEFT);

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

        return view('/admins.final_results', [
            'actel_user' => $actel_user,
            'candidats' => $candidats,
            'totalVotes' => $totalVotes,
            'pieChartData' => $pieChartData, // Ajoutez les données du premier graphique à la vue
            'barChartData' => $barChartData, // Ajoutez les données du deuxième graphique à la vue
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new StudentImport(), request()->file('excel_file'));

        return redirect()
            ->back()
            ->with('success', 'fichier importé avec succès');
    }
    public function import_classe(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx',
        ]);
        $data = Excel::import(
            new ClasseImport(),
            request()->file('excel_file')
        );

        return redirect()
            ->back()
            ->with('success', 'fichier importé avec succès');
    }

    public function file(Request $request)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);

        return view('/admins/import_file', ['actel_user' => $actel_user]);
    }
    public function file_classe(Request $request)
    {
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);

        return view('/admins/import_classes', ['actel_user' => $actel_user]);
    }

    public function vote(Request $request)
    {
        $userId = 1;
        $candidatId = $request->input('candidat_id');
        $currentVotes = $request->input('current_votes'); // Récupérez le nombre actuel de votes

        $query = Vote::create([
            'user_id' => $userId,
            'candidat_id' => $candidatId,
        ]);

        if ($query) {
            $totalVotes = $currentVotes + 1; // Calculez le nouveau total
            return response()->json([
                'success' => true,
                'totalVotes' => $totalVotes,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'enregistrement du vote.',
            ]);
        }
    }

    public function removeVote(Request $request)
    {
        $userId = 1;
        $candidatId = $request->input('candidat_id');
        $currentVotes = $request->input('current_votes'); // Récupérez le nombre actuel de votes

        $query = DB::table('votes')
            ->where('user_id', $userId)
            ->where('candidat_id', $candidatId)
            ->orderBy('id', 'DESC')
            ->take(1)
            ->delete();

        if ($query) {
            $totalVotes = $currentVotes - 1; // Calculez le nouveau total
            return response()->json([
                'success' => true,
                'totalVotes' => $totalVotes,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du retrait du vote.',
            ]);
        }
    }
    public function classement(Request $request)
    {
        // Récupération des candidats et des votes
        $candidats = Candidat::all();
        $votes = Vote::all();

        // Calcul du total des votes
        $totalVotes = $votes->count();
        // dd($totalVotes);
        // Calcul des votes pour chaque candidat et tri par ordre décroissant
        $candidats = $candidats
            ->map(function ($candidat) use ($votes) {
                $candidatVotes = $votes
                    ->where('candidat_id', $candidat->id)
                    ->count();

                $candidat->totalVotes = $candidatVotes;

                return $candidat;
            })
            ->sortByDesc('totalVotes')
            ->take(3);
        //  dd($candidats);
        // Obtenez le candidat avec le plus grand nombre de votes (indice 0 après le tri)
        $president = $candidats->first();

        // Obtenez le candidat avec le deuxième plus grand nombre de votes (indice 1 après le tri)
        $vicePresident = $candidats->skip(1)->first();

        // Obtenez le candidat avec le troisième plus grand nombre de votes (indice 2 après le tri)
        $secretaireGeneral = $candidats->skip(2)->first();

        // Attribuez les titres et couleurs en fonction du classement
        $president->color = 'success';
        $president->titre = 'Président LEADER MANAGER';

        $vicePresident->color = 'warning';
        $vicePresident->titre = 'Vice-Président';

        $secretaireGeneral->color = 'primary';
        $secretaireGeneral->titre = 'Secrétaire Général';
        $PasseUser = $request->session()->get('PasseUser');
        $actel_user = Admin::find($PasseUser);

        return view('/admins.classement', [
            'actel_user' => $actel_user,
            'candidats' => $candidats,
            'totalVotes' => $totalVotes,
        ]);
    }
}
