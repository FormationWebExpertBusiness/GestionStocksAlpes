<?php

namespace App\Http\Livewire\Forms\Category;

use App\Models\Category;
use App\Rules\DifferentThanNonDefini;
use Livewire\Component;

class CategoryEditForm extends Component
{
    public $show = false;
    public $categories;
    public $showDropdown = false;
    public $selectedCategory;
    public $newName;

    protected $rules = [
        'selectedCategory' => ['required'],
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
        array_push($this->rules['selectedCategory'], new DifferentThanNonDefini());
        $this->validateOnly($property);
    }

    public function updateCategory()
    {
        array_push($this->rules['selectedCategory'], new DifferentThanNonDefini());
        $this->validate();
        $categorie = Category::find($this->selectedCategory);
        $oldName = $categorie->name;
        $categorie->update(['name' => $this->newName]);
        $this->toggleEditForm();
        return redirect('stock')->with('status', 'Le nom de la categorie '.$oldName.' a bien été changé en '.$this->newName.' !');
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
