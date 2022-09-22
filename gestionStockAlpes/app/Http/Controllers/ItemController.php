<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    /* Affiche le formulaire de création */
    public function displayForm($id = null){
        return view('item-form', 
        [
            'item' => Item::find($id)
        ]);
    }

    public function SaveItem()
    {
        $validated = $this->validate([
            'quantity' => 'required',
            'model' => 'required'
        ]);

        session()->flash('message', 'Objet ajouté.');

        $this->resetInputFields();
    }

    public function update()
    {

        $validated = $this->validate([

            'title' => 'required',

            'body' => 'required',

        ]);
        $post = Post::find($this->post_id);

        $post->update([

            'title' => $this->title,

            'body' => $this->body,

        ]);

        $this->updateMode = false;

        session()->flash('message', 'Post Updated Successfully.');

        $this->resetInputFields();
    }
    
}
