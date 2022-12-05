<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CommonProduct extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'common_products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'brand_id',
        'model',
        'favorite',
        'quantity_low',
        'quantity_critical',
        'photo_product',
    ];

    protected $with = [
        'brand',
        'category',
        'products',
    ];

    protected $appends = [
        'quantity',
        'totalPrice',
    ];

    public function getQuantityAttribute()
    {
        return $this->products()->count();
    }

    public function getTotalPriceAttribute()
    {
        return $this->products()->sum('price');
    }

    public function unitPrice()
    {
        return $this->totalPrice / $this->quantity;
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'common_id', 'id');
    }

    public function hasProduct()
    {
        return $this->quantity > 0;
    }

    public function productsOnRack(?array $rack = [], ?array $rack_level = [])
    {
        if (count($rack ?? []) === 0) {
            $rack = Rack::pluck('id')->toArray();
        }

        if (count($rack_level ?? []) === 0) {
            $nb_levelMax = Rack::all()->max('nb_level');
            for ($i = 1; $i <= $nb_levelMax; $i++) {
                $rack_level[] = $i;
            }
        }

        return $this->products->filter(function ($value) use ($rack, $rack_level) {
            if (in_array($value->rack_id, $rack) && in_array($value->rack_level, $rack_level)) {
                return $value;
            }
        })->values();
    }

    public function quantityOnRack(?array $rack = [], ?array $rack_level = [])
    {
        return $this->productsOnRack($rack, $rack_level)->count();
    }

    public function totalPriceOnRack(?array $rack = [], ?array $rack_level = [])
    {
        return $this->productsOnRack($rack, $rack_level)->sum('price');
    }

    public function unitPriceOnRack(?array $rack = [], ?array $rack_level = [])
    {
        return $this->totalPriceOnRack($rack, $rack_level) / $this->quantityOnRack($rack, $rack_level);
    }

    public static function filterOnQuantities($commonProducts, $quantityMin, $quantityMax)
    {
        return $commonProducts->filter(function ($value) use ($quantityMin, $quantityMax) {
            $quantity = $value->quantity;
            if ($quantity >= $quantityMin
             && ($quantity <= $quantityMax || ! $quantityMax)) {
                return $value;
            }
        })->values();
    }

    public static function filterOnRacksQuantities($commonProducts, $quantityMin, $quantityMax, $racks, $rackLevels)
    {
        return $commonProducts->filter(function ($value) use ($quantityMin, $quantityMax, $racks, $rackLevels) {
            $quantity = $value->quantityOnRack($racks, $rackLevels);
            if ($quantity >= $quantityMin
             && ($quantity <= $quantityMax || ! $quantityMax)
             && $quantity > 0) {
                return $value;
            }
        })->values();
    }

    public static function filterOnBrands($commonProducts, $brands)
    {
        $brands = count($brands) === 0 ? Brand::pluck('id')->toArray() : $brands;
        return $commonProducts->filter(function ($value) use ($brands) {
            if (in_array($value->brand->id, $brands)) {
                return $value;
            }
        })->values();
    }

    public static function filterOnCategories($commonProducts, $categories)
    {
        $categories = count($categories) === 0 ? Category::pluck('id')->toArray() : $categories;
        return $commonProducts->filter(function ($value) use ($categories) {
            if (in_array($value->category->id, $categories)) {
                return $value;
            }
        })->values();
    }

    public static function sortOnCategories($commonProducts, $mode)
    {
        return $commonProducts->sortBy([['category.name', $mode]])->values();
    }

    public static function sortOnBrands($commonProducts, $mode)
    {
        return $commonProducts->sortBy([['brand.name', $mode]])->values();
    }

    public static function sortOnModels($commonProducts, $mode)
    {
        return $commonProducts->sortBy([['model', $mode]])->values();
    }

    public static function sortOnQuantitiesOnRack($commonProducts, $mode, $racksF, $rackLevelsF)
    {
        return $commonProducts->sortBy(function ($commonProduct) use ($mode, $racksF, $rackLevelsF) {
            if ($mode === 'asc') {
                return $commonProduct->quantityOnRack($racksF, $rackLevelsF);
            }
            return - $commonProduct->quantityOnRack($racksF, $rackLevelsF);
        })->values();
    }

    public static function sortOnTotalPricesOnRack($commonProducts, $mode, $racksF, $rackLevelsF)
    {
        return $commonProducts->sortBy(function ($commonProduct) use ($mode, $racksF, $rackLevelsF) {
            if ($mode === 'asc') {
                return $commonProduct->totalPriceOnRack($racksF, $rackLevelsF);
            }
            return - $commonProduct->totalPriceOnRack($racksF, $rackLevelsF);
        })->values();
    }

    public static function totalQuantity()
    {
        return CommonProduct::all()->sum('quantity');
    }

    public static function totalCommonProduct()
    {
        return CommonProduct::all()->count('id');
    }

    public static function totalFavoriteProduct()
    {
        return CommonProduct::where('favorite', '=', true)->get()->count();
    }

    public static function totalOutStockProduct()
    {
        return CommonProduct::all()->filter(function ($value) {
            if ($value->quantity <= $value->quantity_critical) {
                return $value;
            }
        })->count();
    }
}
