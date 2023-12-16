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

    // Vérifier si le matricule existe dans la base de données locale
    $userInfo = DB::table('students')
        ->where('matricule', $request->matricule)
        ->first();

    if (!$userInfo) {
        return back()->with('fail', 'Ce matricule n\'existe pas');
    }

    // Vérifier si le matricule a déjà voté
    $hasVoted = DB::table('votes')
        ->where('user_id', '=', $userInfo->id)
        ->count();

    if ($hasVoted > 0) {
        return back()->with('fail', 'Ce matricule a déjà voté');
    }

    // Faire la requête à l'API externe
    $apiResponse = Http::withHeaders([
        'accept' => '*/*',
        'Content-Type' => 'application/json',
    ])->post('https://api-staging.supmanagement.ml/auth/login', [
        'username' => $request->matricule,
        'password' => $request->password,
        'rememberMe' => true,
    ]);

    if ($apiResponse->successful()) {
        $token = $apiResponse->body();
        $request->session()->put('jwt_token', $token);
        dd($token);
        
        // Enregistrement de l'adresse IP
        DB::table('addresses')->insert([
            'user_id' => $userInfo->id,
            'ip_address' => $request->ip(),
        ]);

        $request->session()->put('PasseUser', $userInfo->id);

        return redirect('/posts/form');
    } else {
        // L'authentification a échoué avec l'API externe
        $errorData = $apiResponse->json();
            return back()->with('fail', 'Erreur d\'accès au serveur');

        if ($apiResponse->status() === 401) {
            return back()->with('fail', 'Mot de passe incorrect');
        }

        return back()->with('fail', 'Échec de l\'authentification avec l\'API externe: ' . $errorData['message']);
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
