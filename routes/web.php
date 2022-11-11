<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\LoginController;

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
Route::post('/posts/validate', [CheckController::class, 'valide'])->name('validate');
//Admin
Route::get('/admins/login', [AdminController::class, 'Admincheck']);
Route::post('/admins/check', [AdminController::class, 'check']);

Route::middleware(['isAdmin'])->group(function () {
    Route::get('/admins/dashboard', [AdminController::class, 'administrator']);
    Route::post('/admins/dashboard', [AdminController::class, 'administrator']);
    Route::get('/admins/dep', [AdminController::class, 'dep']);
    Route::get('/admins/statut', [AdminController::class, 'statut']);
    Route::get('/admins/results', [AdminController::class, 'results']);
    Route::get('/admins/dep_results', [AdminController::class, 'dep_results']);
    Route::get('/admins/final_results', [AdminController::class, 'final_results']);
    Route::get('/posts/inscrit', [LoginController::class, 'inscription']);

  });

