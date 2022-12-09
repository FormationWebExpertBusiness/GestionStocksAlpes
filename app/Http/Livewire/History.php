<?php

namespace App\Http\Livewire;

use App\Models\HistoryProduct;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;

    public $isVisibleCat = false;
    public $isVisibleBrand = false;

    public $categories;
    public $brands;

    public $catsFilter = [];
    public $brandsFilter = [];
    public $dateFrom;
    public $dateTo;
    public $searchFilter;

    public $readyToLoad = false;

    private $historyProducts;

    public function resetFilters()
    {
        $this->catsFilter = [];
        $this->brandsFilter = [];
        $this->searchFilter = '';
        $this->dateFrom = HistoryProduct::oldestDate();
        $this->dateTo = HistoryProduct::newestDate();
    }

    public function filterOnSearchBar()
    {
        if ($this->searchFilter) {
            $this->historyProducts = HistoryProduct::select('history_products.*')
                ->where('history_products.model', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('history_products.serial_number', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('history_products.comment', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('history_products.category', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('history_products.brand', 'LIKE', '%'.$this->searchFilter.'%')
                ->orderByDesc('created_at')
                ->get();
        } else {
            $this->historyProducts = HistoryProduct::orderByDesc('created_at')
                ->get();
        }
    }

    public function loadData()
    {
        $this->readyToLoad = true;
    }

    public function collectionToPaginator()
    {
        $perPage = 50;

        $historyProductsOnPage = $this->historyProducts->forPage($this->page, $perPage);

        return new LengthAwarePaginator($historyProductsOnPage, $this->historyProducts->count(), $perPage, $this->page);
    }

    public function updated($property)
    {
        if (! $this->$property) {
            if ($property === 'dateFrom') {
                $this->dateFrom = HistoryProduct::oldestDate();
            } elseif ($property === 'dateTo') {
                $this->dateTo = HistoryProduct::newestDate();
            }
        }
    }

    public function mount()
    {
        $this->resetFilters();
    }

    public function render()
    {
        $this->brands = HistoryProduct::getAllBrands();

        $this->categories = HistoryProduct::getAllCategories();

        if ($this->readyToLoad) {
            $this->filterOnSearchBar();
            $this->historyProducts = HistoryProduct::filterOnBrands($this->historyProducts, $this->brandsFilter);
            $this->historyProducts = HistoryProduct::filterOnCategories($this->historyProducts, $this->catsFilter);
            $this->historyProducts = HistoryProduct::filterOnMovedAfter($this->historyProducts, $this->dateFrom);
            $this->historyProducts = HistoryProduct::filterOnMovedBefore($this->historyProducts, $this->dateTo);
        } else {
            $this->historyProducts = collect();
        }

        $paginatedHistoProducts = $this->collectionToPaginator();

        return view('livewire.history', ['historyProducts' => $paginatedHistoProducts])->layout('layout');
    }
}
