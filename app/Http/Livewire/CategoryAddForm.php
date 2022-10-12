<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryAddForm extends Component
{
    public $name;
    public $show = false;

    protected $rules = [
        'name' => ['alpha_dash', 'unique:App\Models\Category,name'],
    ];
    protected $messages = [
        'name.alpha_dash' => 'Le nom de la catégorie ne doit contenir que des lettres, des chiffres',
        'name.unique' => 'Le nom de la catégorie doit être unique'
    ];
    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function saveCategory()
    {
        $this->validate();
        Category::create([
            'name' => $this->name,
            ]);
        $this->toggleAddForm();
    }

    public function toggleAddForm()
    {
        $this->show = !$this->show;
        $this->name = "";
    }

    public function render()
    {
        return view('livewire.category-add-form');
    }
}
