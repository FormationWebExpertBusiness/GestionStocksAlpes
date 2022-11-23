<?php

namespace App\Http\Livewire\Forms\Category;

use App\Models\Category;
use Livewire\Component;

class CategoryDeleteForm extends Component
{
    public $show = false;
    public $category;

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

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function toggleDeleteForm()
    {
        $this->show = ! $this->show;
    }

    public function openWarningDelete()
    {
        $this->validate();
        $deleteMessage = '';
        if ($this->category->hasCommonItem()) {
            $deleteMessage = '⚠️ Des produits existent pour cette catégorie, si vous la supprimez, la catégorie des produits associés sera modifiée en "Non définie"';
        }

        $this->emit('deleteWarning', $this->category->id, $this->warningDeleteCategorySignal, 'Category', 'name', $deleteMessage);
    }

    public function deleteCategory($categoryId)
    {
        Category::find($categoryId)->delete();
        $this->toggleDeleteForm();
        return redirect('/configuration/category')->with('status', 'La categorie '.$this->selectedCategory.' a bien été supprimé !');
    }

    public function render()
    {
        return view('livewire.forms.category.category-delete-form');
    }
}
