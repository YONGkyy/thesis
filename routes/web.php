<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ThesisAdvisorController;
use App\Http\Controllers\ThesisCommitteeController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\ThesisDetailController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectToDashbordIfLoggedIn;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get('/', function(){
    return redirect()->route('dashboard');
});

Route::middleware('checkAuth')->group(function () {

    // thesis
    // Route::prefix('/thesis')
    // ->controller(ThesisController::class)
    // ->name('thesis.')->group(function () {
    //     // thesis
    //     // 1. List all rooms
    //     Route::get('/',  'index')->name('index');
    //     // 2. Create a thesis
    //     Route::get('/create',  'create')->name('create');
    //     // 3. show edit form

    //     Route::get('/edit/{id}',  'edit')->name('edit');

    //     // 4. Store or Update a thesis
    //     Route::post('/store/{id?}',  'store')->name('store');
    //     // 5. Delete a thesis

    //     Route::delete('/delete/{id}', 'destroy')->name('destroy');


    //     Route::post('/update/{id}', 'update')->name('update');
    // });
        // thesisCommittee
    // Route::prefix('/thesisCommittee')
    // ->controller(ThesisCommitteeController::class)
    // ->name('thesisCommittee.')->group(function () {
    //     // thesisCommittee
    //     // 1. List all thesisCommittees
    //     Route::get('/',  'index')->name('index');
    //     // 2. Create a thesisCommittee
    //     Route::get('/create',  'create')->name('create');
    //     // 3. show edit form

    //     Route::get('/edit/{Academic_Year}',  'edit')->name('edit');

    //     // 4. Store or Update a thesisCommittee
    //     Route::post('/store/{Academic_Year?}',  'store')->name('store');

    //     // 5. Delete a thesisCommittee

    //     Route::delete('/delete/{Academic_Year}', 'destroy')->name('destroy');

    //     Route::post('/update/{Academic_Year}', 'update')->name('update');
    // });

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

require __DIR__.'/auth.php';
