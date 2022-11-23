<?php

namespace App\Http\Livewire\Configuration;

use App\Models\Category;
use App\Models\CommonItem;
use Livewire\Component;

class ConfigCategories extends Component
{
    public $showDropdown = false;
    public $categories;
    public $warningDeleteItemSignal = 'deleteCategory';

    public $showToast = true;

    protected $listeners = [
        'deleteCategory' => 'deleteCat',
    ];

    public function openWarningDelete($categoryId)
    {
        $category = Category::find($categoryId);
        $deleteMessage = '';
        if (CommonItem::where('category_id', $categoryId)->count() > 0) {
            $deleteMessage = '⚠️ Des produits de la catégorie ' . $category->name . 'existent dans le stock, si vous supprimez, les produits leur catégorie à "Non définie"';
        }
        $this->emit('deleteWarning', $categoryId, $this->warningDeleteItemSignal, 'Category', 'name', $deleteMessage);
    }

    public function deleteCat($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();
        return redirect()->with('status', 'La catégorie '.$category->name.' a bien été supprimé !');
    }

    public function toggleDropdown()
    {
        $this->showDropdown = ! $this->showDropdown;
    }

    public function render()
    {
        $this->categories = Category::where('id', '<>', 1)->get();
        return view('livewire.configuration.config-categories')->layout('layout');
    }
}
