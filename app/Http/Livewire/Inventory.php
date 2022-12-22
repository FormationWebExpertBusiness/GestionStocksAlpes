<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class Inventory extends Component
{
    use WithPagination;

    public $catsFilter = [];
    public $brandsFilter = [];
    public $commonProductsFilter = [];
    public $racksFilter = [];
    public $rackLevelsFilter = [];

    public $searchFilter;

    public $champ;
    public $mode;
    public $readyToLoad = false;
    public $showToast = true;

    public $warningDeleteProductSignal = 'deleteProduct';

    protected $queryString = [
        'champ' => ['except' => 'id', 'as' => 'cha'],
        'mode' => ['as' => 'mod'],
        'catsFilter' => ['as' => 'cat'],
        'brandsFilter' => ['as' => 'bra'],
        'commonProductsFilter' => ['as' => 'com'],
        'racksFilter' => ['as' => 'rac'],
        'rackLevelsFilter' => ['as' => 'rlv'],
        'searchFilter' => ['except' => '', 'as' => 'sea'],
    ];

    private $products;

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

    public function updateCatsFilter($cats)
    {
        $this->catsFilter = $cats;
    }

    public function updateBrandsFilter($brands)
    {
        $this->brandsFilter = $brands;
    }

    public function updateCommonProductsFilter($commonProducts)
    {
        $this->commonProductsFilter = $commonProducts;
    }

    public function updateRacksFilter($racks)
    {
        $this->racksFilter = $racks;
    }

    public function updateRackLevelsFilter($rackLevels)
    {
        $this->rackLevelsFilter = $rackLevels;
    }

    public function searchFilter($search)
    {
        $this->searchFilter = $search;
    }

    public function resetFilters()
    {
        $this->catsFilter = [];
        $this->brandsFilter = [];
        $this->commonProductsFilter = [];
        $this->racksFilter = [];
        $this->rackLevelsFilter = [];
    }

    public function toggleMode()
    {
        if ($this->mode === 'asc') {
            $this->mode = 'desc';
        } else {
            $this->mode = 'asc';
        }
    }

    public function reOrder($champO)
    {
        $this->toggleMode();
        $this->champ = $champO;
    }

    public function sortProducts()
    {
        switch ($this->champ) {
            case 'created_at':
                $this->products = Product::sortOnCreatedAt($this->products, $this->mode);
                break;
            case 'category':
                $this->products = Product::sortOnCategories($this->products, $this->mode);
                break;
            case 'brand':
                $this->products = Product::sortOnBrands($this->products, $this->mode);
                break;
            case 'model':
                $this->products = Product::sortOnModels($this->products, $this->mode);
                break;
            case 'serial_number':
                $this->products = Product::sortOnSerialNumbers($this->products, $this->mode);
                break;
            case 'rack':
                $this->products = Product::sortOnRacks($this->products, $this->mode);
                break;
            case 'price':
                $this->products = Product::sortOnPrices($this->products, $this->mode);
                break;
        }
    }

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function closeToast()
    {
        $this->showToast = false;
    }

    public function filterOnSearchBar()
    {
        if ($this->searchFilter) {
            $this->products = Product::select('products.*')
                ->join('common_products', 'products.common_id', '=', 'common_products.id')
                ->join('brands', 'common_products.brand_id', '=', 'brands.id')
                ->join('categories', 'common_products.category_id', '=', 'categories.id')
                ->where('common_products.model', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('categories.name', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('brands.name', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('products.serial_number', 'LIKE', '%'.$this->searchFilter.'%')
                ->get();
        } else {
            $this->products = Product::get();
        }
    }

    public function collectionToPaginator()
    {
        $perPage = 12;

        $productsOnPage = $this->products->forPage($this->page, $perPage);

        return new LengthAwarePaginator($productsOnPage, $this->products->count(), $perPage, $this->page);
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $this->loadProducts();
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
            'catsFilter' => 'updateCatsFilter',
            'brandsFilter' => 'updateBrandsFilter',
            'commonProductsFilter' => 'updateCommonProductsFilter',
            'racksFilter' => 'updateRacksFilter',
            'rackLevelsFilter' => 'updateRackLevelsFilter',
            'searchFilter' => 'searchFilter',
            'resetFilters' => 'resetFilters',
        ];
    }

    private function loadProducts()
    {
        $this->filterOnSearchBar();
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
        $this->sortProducts();
    }
}
