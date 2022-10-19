<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

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
