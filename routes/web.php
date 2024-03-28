<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThesisAdvisorController;
use App\Http\Controllers\ThesisCommitteeController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\ThesisDetailController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectToDashbordIfLoggedIn;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/count', function(){
//     return inertia('Count');
// });
=======
>>>>>>> yong
Route::get('/', function(){
    return redirect()->route('dashboard');
});

Route::middleware('checkAuth')->group(function () {

    // // thesis
    Route::resource('/thesis', ThesisController::class);

    // thesisAdvisor
    Route::resource('/thesisAdvisor', ThesisAdvisorController::class);

    // thesisCommittee
    Route::resource('/thesisCommittee', ThesisCommitteeController::class);

    // thesisDetail
    Route::resource('/thesisDetail', ThesisDetailController::class);

    // logout
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Dashboard
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

// show login page
Route::get('/login', [UserController::class, 'login'])
    ->middleware(RedirectToDashbordIfLoggedIn::class)
    ->name('login');

// get login data from user input
Route::post('/login', [UserController::class, 'verifyLogin'])->name('login.verify');
<<<<<<< HEAD

require __DIR__.'/auth.php';
=======
>>>>>>> yong
