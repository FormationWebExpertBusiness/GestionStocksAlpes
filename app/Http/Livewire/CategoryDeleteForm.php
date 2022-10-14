<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryDeleteForm extends Component
{
    public $show = false;
    public $categories;
    public $showDropdown = false;
    public $selectedCategory;

    public $warningDeleteCategorySignal = 'deleteCategory';

    protected $listeners = [
        'deleteCategory' => 'deleteCategory'
    ];

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function toggleDeleteForm()
    {
        $this->show = !$this->show;
    }

    public function openWarningDelete()
    {
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
        return view('livewire.category-delete-form');
    }
}
