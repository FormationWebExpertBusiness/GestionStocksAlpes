<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Item;

class AddOrEditItem extends Component
{

    public $item;

    public function render()
    {
        $this->$item = new Item();
        return view('livewire.add-or-edit-objet', [
            'item' => $this->$item
        ]);
    }

    private function resetInputFields(){
        $this->$item = new Item();
    }

    public function store()
    {
        $validated = $this->validate([
            'quantity' => 'required',
            'model' => 'required'
        ]);

        session()->flash('message', 'Objet ajouté.');

        $this->resetInputFields();
    }


    public function edit($id)
    {
        $this->$item = Item::findOrFail($id);

        $this->updateMode = true;
    }

    public function update()
    {

        $validatedDate = $this->validate([

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