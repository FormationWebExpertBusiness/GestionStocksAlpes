<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\CommonProduct;
use App\Models\Product;
use App\Models\Rack;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Inventory extends Component
{
    use WithPagination;

    public $isVisibleCat = false;
    public $isVisibleBrand = false;
    public $isVisibleCommonProduct = false;
    public $isVisibleRack = false;
    public $isVisibleRackLevel = false;

    public $categories;
    public $brands;
    public $commonProducts;
    public $racks;
    public $rackLevels;

    public $catsFilter = [];
    public $brandsFilter = [];
    public $commonProductsFilter = [];
    public $racksFilter = [];
    public $rackLevelsFilter = [];

    public $searchFilter;

    protected $queryString = [
        // 'champ' => ['except' => 'id', 'as' => 'cha'],
        // 'mode' => ['as' => 'mod'],
        'catsFilter' => ['as' => 'cat'],
        'brandsFilter' => ['as' => 'bra'],
        'commonProductsFilter' => ['as' => 'com'],
        'racksFilter' => ['as' => 'rac'],
        'rackLevelsFilter' => ['as' => 'rlv'],
        'searchFilter' => ['except' => '', 'as' => 'sea'],
    ];

    private $products;
    public $readyToLoad = false;
    public $showToast = true;

    public $warningDeleteProductSignal = 'deleteProduct';

    public function openWarningDelete($productId)
    {
        $this->emit('deleteWarning', $productId, $this->warningDeleteProductSignal, 'Product', 'serial_number');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Le produit '.$product->serial_number.' a bien été supprimé !']);
        $this->emit('refreshComponent');
    }

    public function resetFilters()
    {
        $this->catsFilter = [];
        $this->brandsFilter = [];
        $this->commonProductsFilter = [];
        $this->racksFilter = [];
        $this->rackLevelsFilter = [];
    }

    public function getAllFilters()
    {
        $catsFilter = [];
        $brandsFilter = [];
        $commonProductsFilter = [];
        $racksFilter = [];
        $rackLevelsFilter = [];
        foreach ($this->catsFilter as $filter) {
            $catsFilter[] = $this->categories->where('id', $filter)->first()->name;
        }

        foreach ($this->brandsFilter as $filter) {
            $brandsFilter[] = $this->brands->where('id', $filter)->first()->name;
        }

        foreach ($this->commonProductsFilter as $filter) {
            $commonProductsFilter[] = $this->commonProducts->where('id', $filter)->first()->model;
        }

        foreach ($this->racksFilter as $filter) {
            $racksFilter[] = $this->racks->where('id', $filter)->first()->name;
        }

        foreach ($this->rackLevelsFilter as $filter) {
            $rackLevelsFilter[] = 'Étage '.$filter;
        }

        return array_merge($catsFilter, $brandsFilter, $commonProductsFilter, $racksFilter, $rackLevelsFilter);
    }

    public function resetSearchBar()
    {
        $this->search = '';
    }

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function closeToast()
    {
        $this->showToast = false;
    }

    public function collectionToPaginator()
    {
        $perPage = 20;

        $productsOnPage = $this->products->forPage($this->page, $perPage);

        return new LengthAwarePaginator($productsOnPage, $this->products->count(), $perPage, $this->page);
    }

    public function render()
    {
        $this->brands = Category::getLinkedBrands($this->catsFilter);

        $this->categories = Category::all();

        $this->commonProducts = CommonProduct::all();

        $this->racks = Rack::all();

        $levelMax = Rack::getRackLevelMax($this->racksFilter);
        $this->rackLevels = collect();
        for ($i = 1; $i <= $levelMax; $i++) {
            $this->rackLevels->push($i);
        }

        if ($this->readyToLoad) {
            $this->products = Product::all();

            if ($this->catsFilter) {
                $this->products = Product::filterOnCategories($this->products, $this->catsFilter);
            }
            if ($this->brandsFilter) {
                $this->products = Product::filterOnBrands($this->products, $this->brandsFilter);
            }
            if ($this->commonProductsFilter) {
                $this->products = Product::filterOnCommonProduct($this->products, $this->commonProductsFilter);
            }
            if ($this->racksFilter) {
                $this->products = Product::filterOnRack($this->products, $this->racksFilter);
            }
            if ($this->rackLevelsFilter) {
                $this->products = Product::filterOnRackLevel($this->products, $this->rackLevelsFilter);
            }
        } else {
            $this->products = collect();
        }
        $paginatedProducts = $this->collectionToPaginator();
        return view('livewire.inventory', ['products' => $paginatedProducts])->layout('layout');
    }

    protected function getListeners()
    {
        return [
            'deleteProduct' => 'deleteProduct',
            'refreshComponent' => '$refresh',
        ];
    }
}
