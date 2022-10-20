<?php

namespace App\Http\Livewire\Forms\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryAddForm extends Component
{
    public $name;
    public $show = false;

    protected $rules = [
        'name' => ['required', 'alpha_dash', 'unique:App\Models\Category,name'],
    ];
    protected $messages = [
        'name.required' => 'Le nom dois être renseigné',
        'name.alpha_dash' => 'Le nom de la catégorie ne doit contenir que des lettres, des chiffres',
        'name.unique' => 'Le nom de la catégorie doit être unique',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function saveCategory()
    {
        $nom = $this->name;
        $this->validate();
        Category::create([
            'name' => $this->name,
        ]);
        $this->toggleAddForm();
        return redirect('stock')->with('status', 'La categorie '.$nom.' a bien été ajouté !');
    }

    public function toggleAddForm()
    {
        $this->show = ! $this->show;
        $this->name = '';
    }

    public function render()
    {
        return view('livewire.forms.category.category-add-form');
    }
}
