<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThesisAdvisorController;
use App\Http\Controllers\ThesisCommitteeController;
use App\Http\Controllers\ThesisController;
use App\Http\Controllers\ThesisDetailController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectToDashbordIfLoggedIn;
use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

});

// show login page
Route::get('/login', [UserController::class, 'login'])
    ->middleware(RedirectToDashbordIfLoggedIn::class)
    ->name('login');

// get login data from user input
Route::post('/login', [UserController::class, 'verifyLogin'])->name('login.verify');
