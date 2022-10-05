<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class displayController extends Controller
{
    public function displayItem(){
        return view('displayItem');
    }

    public function displayStock(){
        return view('displayStock');
    }
}
