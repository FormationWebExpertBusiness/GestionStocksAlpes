<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class displayController extends Controller
{
    public function displayItem(){
        return view('displayItem');
    }

    public function displayStock(){
        $items = Item::all();
        return view('displayStock', [
            'items' => $items
        ]);
    }
}
