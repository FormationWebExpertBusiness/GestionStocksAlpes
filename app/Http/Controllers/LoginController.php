<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function displayLogin()
    {
        return view('displayLogin');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
