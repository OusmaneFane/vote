<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vote;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Carbon\Carbon;

class CheckController extends Controller
{
    public function check(Request $request)
    {
        $request->validate([
            'matricule' => ['required'],
            'password' => ['required'],
        ]);

        // Vérifier si le temps de vote est dépassé
        $currentTime = now(); // Obtenez la date et l'heure actuelles
        $votingEndTime = Carbon::create($currentTime->year, 12, 22, 23, 59, 59);
        // Définir la fin du temps de vote
        if ($currentTime < $votingEndTime) {
            // Temps de vote dépassé, affichez un message et redirigez l'utilisateur
            return back()->with(
                'fail',
                'Merci de votre intérêt, mais vous ne pouvez plus participer.'
            );
        }

        $student = DB::table('students')
            ->where('matricule', $request->matricule)
            ->first();
        if (!$student) {
            return back()->with(
                'fail',
                'Ce matricule n\'est pas autorisé à voter'
            );
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

        if ($data == null) {
            $token = $apiResponse->body();
            $userData = $request->session()->put('PasseUser', $token);
            $apiResponse = Http::withToken($token)->get(
                'https://api-staging.supmanagement.ml/users/current'
            );
            //dd('yooo', $apiResponse->json());
            // Enregistrement de l'adresse IP
            DB::table('addresses')->insert([
                'user_id' => $student->id,
                'ip_address' => $request->ip(),
            ]);
            $request->session()->put('PasseUser2', $student->id);

            return redirect('/posts/form');
        } elseif ($data['message'] == 'Invalid credentials') {
            return back()->with('fail', 'Mot de passe incorrect');
        } else {
            return back()->with('fail', 'Une erreur s\'est produite');
        }

        return back()->with(
            'fail',
            'Échec de l\'authentification avec l\'API externe: '
        );
    }

    public function valide(Request $request)
    {
        request()->validate([
            'candidat_id' => ['required'],
        ]);
        $PasseUser = $request->session()->get('PasseUser2');
        $actel_user = Student::find($PasseUser);
        // dd($actel_user);
        if (!$actel_user) {
            return back()->with('fail', 'une erreur s\'est produite');
        }
        $matricule = $actel_user->matricule;
        $classe_id = $actel_user->classe_id;
        if (Student::find($actel_user->id)) {
            $query = Vote::create([
                'user_id' => $actel_user->id,
                'candidat_id' => $request->candidat_id,
                'classe_id' => $classe_id,
            ]);

            if ($query) {
                session()->pull('PasseUser');
                return redirect('/')->with(
                    'success',
                    'Vote enregistré avec succès'
                );
            } else {
                return back()->with(
                    'fail',
                    'Une erreur s\'est produite lors de l\'enregistrement du vote'
                );
            }
        } else {
            return back()->with('fail', 'L\'utilisateur n\'existe pas');
        }
    }
}
