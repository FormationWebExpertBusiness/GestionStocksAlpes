<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class displayController extends Controller
{
    public function displayStock(){
        return view('displayStock');
    }
}
