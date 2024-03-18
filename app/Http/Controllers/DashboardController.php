<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $loggedInUser = Auth::user();   
        // dd($loggedInUser);
        return inertia('Dashboard');
    }
}
