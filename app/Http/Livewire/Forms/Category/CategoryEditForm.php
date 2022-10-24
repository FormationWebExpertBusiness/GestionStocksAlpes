<?php

namespace App\Http\Livewire\Forms\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryEditForm extends Component
{
    public $show = false;
    public $categories;
    public $showDropdown = false;
    public $selectedCategory;
    public $newName;
    private $nonDefiniName;

    protected $rules = [
        'selectedCategory' => ['required', 'different:nonDefiniName'],
        'newName' => ['required', 'alpha_dash', 'unique:App\Models\Category,name'],
    ];
    protected $messages = [
        'selectedCategory.required' => 'La catégorie à modifier doit être selectionnée',
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
        Category::where('name', $this->selectedCategory)->update(['name' => $this->newName]);
        $this->toggleEditForm();
        return redirect('stock')->with('status', 'Le nom de la categorie '.$this->selectedCategory.' a bien été changé en '.$this->newName.' !');
    }

    public function toggleEditForm()
    {
        $this->show = ! $this->show;
    }

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.forms.category.category-edit-form');
    }
}
