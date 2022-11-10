<?php

namespace App\Http\Livewire;

use App\Models\HistoryItem;
use Livewire\Component;

class History extends Component
{
    public $historyItems;

    public $isVisibleCat = false;
    public $isVisibleBrand = false;

    public $categories;
    public $brands;

    public $catsFilter = [];
    public $brandsFilter = [];
    public $dateFrom;
    public $dateTo;
    public $searchFilter;

    public function resetFilters()
    {
        $this->catsFilter = [];
        $this->brandsFilter = [];
        $this->searchFilter = '';
        $this->dateFrom = HistoryItem::oldestDate();
        $this->dateTo = HistoryItem::newestDate();
    }

    public function filterOnSearchBar()
    {
        if ($this->searchFilter) {
            $this->historyItems = HistoryItem::select('history_items.*')
                ->where('history_items.model', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('history_items.serial_number', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('history_items.comment', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('history_items.category', 'LIKE', '%'.$this->searchFilter.'%')
                ->orWhere('history_items.brand', 'LIKE', '%'.$this->searchFilter.'%')
                ->orderByDesc('created_at')
                ->get();
        } else {
            $this->historyItems = HistoryItem::orderByDesc('created_at')
                ->get();
        }
    }

    public function updated($property)
    {
        if ( ! $this->$property) {
            if ($property === 'dateFrom') {
                $this->dateFrom = HistoryItem::oldestDate();
            } else if ($property === 'dateTo') {
                $this->dateTo = HistoryItem::newestDate();
            }
        }
    }

    public function mount()
    {
        $this->resetFilters();
    }

    public function render()
    {
        $this->brands = HistoryItem::getAllBrands();

        $this->categories = HistoryItem::getAllCategories();

        $this->filterOnSearchBar();
        $this->historyItems = HistoryItem::filterOnBrands($this->historyItems, $this->brandsFilter);
        $this->historyItems = HistoryItem::filterOnCategories($this->historyItems, $this->catsFilter);
        $this->historyItems = HistoryItem::filterOnMovedAfter($this->historyItems,$this->dateFrom);
        $this->historyItems = HistoryItem::filterOnMovedBefore($this->historyItems,$this->dateTo);

        return view('livewire.history')->layout('layout');
    }
}
