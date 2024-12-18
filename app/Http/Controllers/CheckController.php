<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

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
        $votingEndTime = Carbon::create($currentTime->year, 12, 17, 23, 59, 59);
        // dd($votingEndTime, $currentTime);
        // Définir la fin du temps de vote
        if ($currentTime > $votingEndTime) {
            toastr()->info('Merci de votre intérêt, mais vous ne pouvez plus participer.');

            return back();
        }

        $student = DB::table('students')
            ->where('matricule', $request->matricule)
            ->first();
        if (!$student) {
            toastr()->error('Désolé, ce matricule ne figure pas parmi les électeurs autorisés. Veuillez vérifier vos informations.'); // Message modifié

            return back();
        }
        // Vérifier si l'étudiant a déjà voté
        $hasVoted = DB::table('votes')
            ->where('user_id', '=', $student->id)
            ->count();

        if ($hasVoted > 0) {
            toastr()->error('Votre vote a déjà été enregistré !');

            return back();
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
            // dd('yooo', $apiResponse->json());
            // Enregistrement de l'adresse IP
            DB::table('addresses')->insert([
                'user_id' => $student->id,
                'ip_address' => $request->ip(),
            ]);
            $request->session()->put('PasseUser2', $student->id);

            return redirect('/posts/form');
        } elseif ($data['message'] == 'Invalid credentials') {
            toastr()->error('Mot de passe incorrect');

            return back();
        } else {
            toastr()->error('Une erreur s\'est produite');

            return back();
        }
        toastr()->error('Échec de l\'authentification avec l\'API externe:');

        return back();
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
        // Vérification si l'utilisateur a déjà voté

        if (Vote::where('user_id', $actel_user->id)->exists()) {
            return redirect('/')->with(
                'error',
                'Ce matricule a déjà voté !'
            );
        }
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
