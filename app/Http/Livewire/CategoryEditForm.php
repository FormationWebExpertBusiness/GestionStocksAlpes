<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryEditForm extends Component
{
    public $show = false;
    public $categories;
    public $showDropdown = false;
    public $selectedCategory;
    public $newName;

    protected $rules = [
        'newName' => ['alpha_dash', 'unique:App\Models\Category,name'],
    ];
    protected $messages = [
        'newName.alpha_dash' => 'Le nom de la catégorie ne doit contenir que des lettres, des chiffres',
        'newName.unique' => 'Le nom de la catégorie doit être unique',
    ];

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function updateCategory()
    {
        if ($this->selectedCategory !== null) {
            $this->validate();
            Category::where('name', $this->selectedCategory)->update(['name' => $this->newName]);
            $this->toggleEditForm();
            return redirect('stock')->with('status', 'Le nom de la categorie '.$this->selectedCategory.' a bien été changé en '.$this->newName.' !');
        }
    }

    public function toggleEditForm()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.category-edit-form');
    }
}
