<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CandidatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'board']);
Route::post('/posts/form', [LoginController::class, 'form']);
Route::get('/posts/form', [LoginController::class, 'form'])->middleware('list');

Route::get('/posts/login', [LoginController::class, 'login'])->name('login');
//Connexion
Route::post('/posts/check', [CheckController::class, 'check'])->name('check');
//Inscription
Route::post('/posts/trait', [LoginController::class, 'trait']);

//logout
Route::get('/logout', [LoginController::class, 'logout']);
//
Route::post('/posts/validate', [CheckController::class, 'valide'])->name(
    'validate'
);
//Admin
Route::get('/admins/login', [AdminController::class, 'Admincheck']);
Route::post('/admins/check', [AdminController::class, 'check']);
Route::post('/import', [AdminController::class, 'import']);
Route::post('/import_classes', [AdminController::class, 'import_classe']);
// Route pour le vote en Ajax
Route::post('/admins/vote', [AdminController::class, 'vote'])->name(
    'admin.vote'
);
// Route pour le retrait de vote en Ajax
Route::post('/admins/remove-vote', [
    AdminController::class,
    'removeVote',
])->name('admin.removeVote');

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admins/dashboard', [
        AdminController::class,
        'administrator',
    ])->name('dashboard');
    Route::post('/admins/dashboard', [AdminController::class, 'administrator']);
    Route::get('/admins/dep', [AdminController::class, 'dep'])->name(
        'depouillement'
    );
    Route::get('/admins/statut', [AdminController::class, 'statut'])->name(
        're_online'
    );
    Route::get('/admins/status-data', [AdminController::class, 'statutData']);
    Route::get('/admins/dep-data', [AdminController::class, 'depData']);

    Route::get('/admins/results', [AdminController::class, 'results']);
    Route::get('/admins/dep_results', [
        AdminController::class,
        'dep_results',
    ])->name('re_dep');
    Route::get('/admins/final_results', [
        AdminController::class,
        'final_results',
    ])->name('re_final');
    Route::get('/posts/inscrit', [LoginController::class, 'inscription'])->name(
        'add_student'
    );
    Route::get('/import_file', [AdminController::class, 'file']);
    Route::get('/import_classes', [AdminController::class, 'file_classe']);
    Route::get('/classement', [AdminController::class, 'classement'])->name(
        'classement'
    );

    // create candidat
    Route::get('/create_candidat', [CandidatController::class, 'create'])->name(
        'candidats.create'
    );
    Route::post('/admins/store', [CandidatController::class, 'store'])->name(
        'candidats.store'
    );
    //edit candidat
    Route::get('/edit_candidat', [
        CandidatController::class,
        'edit_candidat',
    ])->name('candidats.edit_candidat');
    Route::get('/admins/edit/{id}', [CandidatController::class, 'edit'])->name(
        'candidats.edit'
    );
    Route::put('/admins/update/{id}', [
        CandidatController::class,
        'update',
    ])->name('candidats.update');
    //delete candidat
    Route::delete('/admins/delete/{id}', [
        CandidatController::class,
        'delete',
    ])->name('candidats.destroy');
    Route::get('/realtime-votes', [AdminController::class, 'getRealtimeVotes']);
});
