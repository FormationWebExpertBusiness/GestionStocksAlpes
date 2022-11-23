<?php

namespace App\Http\Livewire\Forms\Category;

use App\Models\Category;
use App\Rules\DifferentThanNonDefini;
use Livewire\Component;

class CategoryEditForm extends Component
{
    public $show = false;
    public $category;
    public $newName;

    protected $rules = [
        'newName' => ['required', 'alpha_dash', 'unique:App\Models\Category,name'],
    ];
    protected $messages = [
        'newName.required' => 'Le nouveau nom de la catégorie séléctionnée doit être renseigné',
        'newName.alpha_dash' => 'Le nom de la catégorie ne doit contenir que des lettres, des chiffres',
        'newName.unique' => 'Le nom de la catégorie doit être unique',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updateCategory()
    {
        $this->validate();
        $oldName = $this->category->name;
        $this->category->update(['name' => $this->newName]);
        $this->toggleEditForm();
        return redirect('/configuration/category')->with('status', 'Le nom de la catégorie '.$oldName.' a bien été changé en '.$this->newName.' !');
    }

    public function toggleEditForm()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        return view('livewire.forms.category.category-edit-form');
    }
}
