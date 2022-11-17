<?php

namespace App\Http\Livewire\Forms\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryDeleteForm extends Component
{
    public $show = false;
    public $categories;
    public $showDropdown = false;
    public $selectedCategory;

    public $warningDeleteCategorySignal = 'deleteCategory';

    protected $listeners = [
        'deleteCategory' => 'deleteCategory',
    ];

    protected $rules = [
        'selectedCategory' => ['required'],
    ];

    protected $messages = [
        'selectedCategory.required' => 'La catégorie à supprimer dois être selectionnée',
    ];

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    public function updated($property)
    {
        if ($this->$property === 'Non défini') {
            $this->$property = null;
        }
        $this->validateOnly($property);
    }

    public function toggleDeleteForm()
    {
        $this->show = ! $this->show;
    }

    public function openWarningDelete()
    {
        $this->validate();
        $category = Category::where('name', $this->selectedCategory)->first();
        $deleteMessage = '';
        if ($category->hasCommonItem()) {
            $deleteMessage = '⚠️ Des produits existent pour cette catégorie, si vous la supprimez, la catégorie des produits associés sera modifiée en "Non définie"';
        }

        $this->emit('deleteWarning', $category->id, $this->warningDeleteCategorySignal, 'Category', 'name', $deleteMessage);
    }

    public function deleteCategory($categoryId)
    {
        Category::find($categoryId)->delete();
        $this->toggleDeleteForm();
        return redirect('/configuration')->with('status', 'La categorie '.$this->selectedCategory.' a bien été supprimé !');
    }

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.forms.category.category-delete-form');
    }
}
