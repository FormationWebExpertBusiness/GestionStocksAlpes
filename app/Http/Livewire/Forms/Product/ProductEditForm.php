<?php

namespace App\Http\Livewire\Forms\Product;

use App\Models\CommonProduct;
use App\Models\Rack;
use Livewire\Component;

class ProductEditForm extends Component
{
    public $show = false;

    public $product;

    public $commonProduct;
    public $commonProducts;

    public $racks;
    public $serial_number;
    public $price;
    public $comment;
    public $rack_id;
    public $rack_level;
    public $common_id;

    protected $rules = [
        'common_id' => ['required'],
        'serial_number' => ['required', 'alpha_num'],
        'price' => ['numeric', 'required', 'min:0'],
        'comment' => ['nullable'],
        'rack_id' => ['integer', 'required'],
        'rack_level' => ['required', 'integer', 'min:1'],
    ];

    protected $messages = [
        'serial_number.required' => 'Le numéro de série dois être renseigné',
        'serial_number.alpha_num' => 'Le numéro de série ne peut contenir que des chiffres et des lettres',
        'price.required' => 'La valeur du stock doit être ajouté.',
        'price.numeric' => 'Le prix doit être un nombre',
        'price.min' => 'Le prix doit être supérieur ou égale à 0',
        'rack_id.integer' => 'L\'élément saisi est incorrect',
        'rack_id.required' => 'L\'emplacement de stockage doit être saisi',
        'rack_level.interger' => 'le niveau de l\'étagère doit être saisie',
        'rack_level.required' => 'L\'emplacement de stockage doit être saisi',
    ];

    public function mount()
    {
        $this->resetInput();
        $this->commonProducts = CommonProduct::all();
        $this->commonProducts = CommonProduct::sortOnModels($this->commonProducts, 'asc');
        $this->commonProducts = CommonProduct::sortOnCategories($this->commonProducts, 'asc');
    }

    public function updated($property)
    {
        $this->validateOnly($property);

        if ($property === 'rack_id' && $this->rack_level > $this->getSelectedRack()?->nb_level) {
            $this->rack_level = null;
        }
    }

    public function saveProduct()
    {
        $nom = $this->serial_number;
        $validatedData = $this->validate();
        $this->product->update($validatedData);
        $this->toggleEditForm();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Le produit '.$nom.' a bien été modifié !']);
        $this->emit('refreshComponent');
    }

    public function toggleEditForm()
    {
        $this->show = ! $this->show;
        $this->resetInput();
    }

    public function getSelectedRack()
    {
        return Rack::find($this->rack_id);
    }

    public function resetInput()
    {
        $this->common_id = $this->product?->common_id;
        $this->serial_number = $this->product?->serial_number;
        $this->price = $this->product?->price;
        $this->comment = $this->product?->comment;
        $this->rack_id = $this->product?->rack_id;
        $this->rack_level = $this->product?->rack_level;

        $this->racks = Rack::all();
    }

    public function render()
    {
        $this->commonProduct = CommonProduct::find($this->common_id) ?? null;
        return view('livewire.forms.product.product-edit-form');
    }
}
