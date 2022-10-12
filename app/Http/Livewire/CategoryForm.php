<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryForm extends Component
{
    public $name;
    public $show = false;

    protected $rules = [
        'name' => ['alpha_dash'],
        'name' => ['unique:App\Models\Category,name']
    ];
    protected $messages = [
        'name.alpha_dash' => 'Le nom de la catégorie ne doit contenir que des lettres, des chiffres',
        'name.unique' => 'Le nom de la catégorie doit être unique'
    ];
    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function saveItem()
    {
        $this->validate();
        Category::create([
            'name' => $this->name,
            ]);

        $this->toggleForm();
    }

    public function toggleForm()
    {
        $this->show = !$this->show;
    }

    public function render()
    {
        return view('livewire.category-form');
    }
}
