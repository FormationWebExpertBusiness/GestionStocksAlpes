<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /* Affiche le formulaire de création */
    public function addItem(){
        return view('livewire/add-or-edit-objet');
    }
}
