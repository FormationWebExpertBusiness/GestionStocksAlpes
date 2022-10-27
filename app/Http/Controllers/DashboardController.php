<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function displayDashboard()
    {
        return view('dashboard');
    }
}
