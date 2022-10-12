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

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function toggleDeleteForm()
    {
        $this->show = !$this->show;
    }

    public function deleteCategory()
    {
        Category::where('name', $this->selectedCategory)->delete();
        $this->toggleDeleteForm();
    }

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.category-delete-form');
    }
}
