<?php

namespace App\Http\Livewire;

use App\Exports\CommonProductExport;
use App\Jobs\NotifyUserOfCompletedExport;
use App\Models\CommonProduct;
use App\Models\CsvExport;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ViewAll extends Component
{
    use WithPagination;

    public $champ = 'id';
    public $mode = 'asc';

    public $quantityMin;
    public $quantityMax;

    public $statusExport;

    public $searchValue = '';

    public $warningDeleteProductSignal = 'deleteProduct';

    public $categoriesF = [];
    public $brandsF = [];
    public $racksF = [];
    public $rackLevelsF = [];
    public $search;

    public $csvExportId;

    public $showToast = true;

    public $paginatedCommonProducts;

    protected $queryString = [
        'champ' => ['except' => 'id', 'as' => 'cha'],
        'mode' => ['as' => 'mod'],
        'categoriesF' => ['as' => 'cat'],
        'brandsF' => ['as' => 'bra'],
        'racksF' => ['as' => 'rac'],
        'rackLevelsF' => ['as' => 'rlv'],
        'searchValue' => ['except' => '', 'as' => 'sea'],
        'quantityMin' => ['except' => '', 'as' => 'qmin'],
        'quantityMax' => ['except' => '', 'as' => 'qmax'],
    ];

    private $commonProducts;

    public function openWarningDelete($commonProductId)
    {
        $deleteMessage = '';
        if (CommonProduct::find($commonProductId)->hasProduct()) {
            $deleteMessage = '⚠️ Des produits existent dans le stock, si vous supprimez, les produits seront aussi supprimés';
        }
        $this->emit('deleteWarning', $commonProductId, $this->warningDeleteProductSignal, 'CommonProduct', 'model', $deleteMessage);
    }

    public function deleteProduct($commonProductId)
    {
        $commonProduct = CommonProduct::findOrFail($commonProductId);
        $commonProduct->delete();
        return redirect()->with('status', 'Le produit '.$commonProduct->model.' a bien été supprimé !');
    }

    public function closeToast()
    {
        $this->showToast = false;
    }

    public function getQuantityMin($quantityMin)
    {
        $this->quantityMin = $quantityMin;
    }

    public function getQuantityMax($quantityMax)
    {
        $this->quantityMax = $quantityMax;
    }

    public function updateCatF($cats)
    {
        $this->categoriesF = $cats;
    }

    public function updateBrandF($brands)
    {
        $this->brandsF = $brands;
    }

    public function updateRackF($racks)
    {
        $this->racksF = $racks;
    }

    public function updateRackLevelF($rackLevels)
    {
        $this->rackLevelsF = $rackLevels;
    }

    public function search($searchV)
    {
        $this->searchValue = $searchV;
    }

    public function resetAllFilters()
    {
        $this->categoriesF = [];
        $this->brandsF = [];
        $this->racksF = [];
        $this->rackLevelsF = [];

        $this->quantityMin = null;
        $this->quantityMax = null;
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

    public function filterOnSearchBar()
    {
        if ($this->searchValue) {
            $this->commonProducts = CommonProduct::select('common_products.*')
                ->join('brands', 'common_products.brand_id', '=', 'brands.id')
                ->join('categories', 'common_products.category_id', '=', 'categories.id')
                ->where('common_products.model', 'LIKE', '%'.$this->searchValue.'%')
                ->orWhere('categories.name', 'LIKE', '%'.$this->searchValue.'%')
                ->orWhere('brands.name', 'LIKE', '%'.$this->searchValue.'%')
                ->get();
        } else {
            $this->commonProducts = CommonProduct::all();
        }
    }

    public function sortCommonProducts()
    {
        switch ($this->champ) {
            case 'category':
                $this->commonProducts = CommonProduct::sortOnCategories($this->commonProducts, $this->mode);
                break;
            case 'brand':
                $this->commonProducts = CommonProduct::sortOnBrands($this->commonProducts, $this->mode);
                break;
            case 'model':
                $this->commonProducts = CommonProduct::sortOnModels($this->commonProducts, $this->mode);
                break;
            case 'quantity':
                $this->commonProducts = CommonProduct::sortOnQuantitiesOnRack($this->commonProducts, $this->mode, $this->racksF, $this->rackLevelsF);
                break;
            case 'price':
                $this->commonProducts = CommonProduct::sortOnTotalPricesOnRack($this->commonProducts, $this->mode, $this->racksF, $this->rackLevelsF);
                break;
        }
    }

    public function collectionToPaginator()
    {
        $perPage = 12;

        $commonProductsOnPage = $this->commonProducts->forPage($this->page, $perPage);

        return new LengthAwarePaginator($commonProductsOnPage, $this->commonProducts->count(), $perPage, $this->page);
    }

    public function render()
    {
        $this->csvExportId = Cache::get('csvExportId');

        $this->filterOnSearchBar();
        $this->commonProducts = CommonProduct::filterOnBrands($this->commonProducts, $this->brandsF);
        $this->commonProducts = CommonProduct::filterOnCategories($this->commonProducts, $this->categoriesF);
        if ($this->racksF || $this->rackLevelsF) {
            $this->commonProducts = CommonProduct::filterOnRacksQuantities($this->commonProducts, $this->quantityMin, $this->quantityMax, $this->racksF, $this->rackLevelsF);
        } else {
            $this->commonProducts = CommonProduct::filterOnQuantities($this->commonProducts, $this->quantityMin, $this->quantityMax);
        }
        $this->sortCommonProducts();
        $paginatedCommonProducts = $this->collectionToPaginator();

        $this->showToast = true;

        return view('livewire.view-all', ['commonProducts' => $paginatedCommonProducts])->layout('layout');
    }

    public function downloadCommonProductCsv()
    {
        Cache::forget('csvExportId');

        $this->exportCommonProductCsvReady();
        return Storage::download('typeproducts.csv');
    }

    public function exportCommonProductCsvReady()
    {
        return redirect('/stock')->with('message', 'Votre export est prêt !');
    }

    public function export()
    {
        $csvExportId = CsvExport::create([
            'user_id' => Auth::user()->id,
        ])->id;

        Cache::forever('csvExportId', $csvExportId);

        (new CommonProductExport())->queue('typeproducts.csv')->chain([
            new NotifyUserOfCompletedExport($csvExportId),
        ]);

        return redirect('/stock')->with('message', 'Votre export à Commencé!');
    }

    public function reloadView()
    {
        return redirect();
    }

    protected function getListeners()
    {
        return [
            'stockUpdated' => 'reloadView',
            'catsFilter' => 'updateCatF',
            'brandsFilter' => 'updateBrandF',
            'racksFilter' => 'updateRackF',
            'rackLevelsFilter' => 'updateRackLevelF',
            'searchFilter' => 'search',
            'resetFilters' => 'resetAllFilters',
            'quantityMin' => 'getQuantityMin',
            'quantityMax' => 'getQuantityMax',
            'deleteProduct' => 'deleteProduct',
            'downloadCommonProductCsv' => 'downloadCommonProductCsv',
            "echo-private:commonproductcsv.{$this->csvExportId},EndedCommonProductCsvExport" => 'downloadCommonProductCsv',
        ];
    }
}
