<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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

    public function deleteCategory(Request $request)
    {
        Category::where('name', $this->selectedCategory)->delete();
        $this->toggleDeleteForm();
        return redirect('stock')->with('status', 'La categorie '.$this->selectedCategory.' a bien été supprimé !');
    }

    public function render()
    {
        $this->categories = Category::all();
        return view('livewire.category-delete-form');
    }
}
