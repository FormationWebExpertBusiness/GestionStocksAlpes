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
        $validatedData = $this->validate();
        $category = Category::where('name', $this->selectedCategory);
        $this->emit('deleteWarning', $category->first()->id, $this->warningDeleteCategorySignal, 'Category', 'name');
    }

    public function deleteCategory($categoryId)
    {
        Category::find($categoryId)->delete();
        $this->toggleDeleteForm();
        return redirect('stock')->with('status', 'La categorie '.$this->selectedCategory.' a bien été supprimé !');
    }

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.forms.category.category-delete-form');
    }
}
