<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonItem extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'common_items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id',
        'brand_id',
        'model',
        'favorite',
        'quantity_urgent',
        'quantity_warning',
    ];

    protected $with = [
        'brand',
        'category',
        'items',
    ];

    protected $appends = [
        'quantity',
        'totalPrice',
    ];

    public function getQuantityAttribute()
    {
        return $this->items()->count();
    }

    public function getTotalPriceAttribute()
    {
        return $this->items()->sum('price');
    }

    public function unitPrice()
    {
        return $this->totalPrice / $this->quantity;
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'common_id', 'id');
    }

    public function hasItem()
    {
        return $this->quantity > 0;
    }

    public function itemsOnRack(?array $rack = [], ?array $rack_level = [])
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

        return $this->items->filter(function ($value) use ($rack, $rack_level) {
            if (in_array($value->rack_id, $rack) && in_array($value->rack_level, $rack_level)) {
                return $value;
            }
        })->values();
    }

    public function quantityOnRack(?array $rack = [], ?array $rack_level = [])
    {
        return $this->itemsOnRack($rack, $rack_level)->count();
    }

    public function totalPriceOnRack(?array $rack = [], ?array $rack_level = [])
    {
        return $this->itemsOnRack($rack, $rack_level)->sum('price');
    }

    public function unitPriceOnRack(?array $rack = [], ?array $rack_level = [])
    {
        return $this->totalPriceOnRack($rack, $rack_level) / $this->quantityOnRack($rack, $rack_level);
    }

    public static function filterOnQuantities($commonItems, $quantityMin, $quantityMax)
    {
        return $commonItems->filter(function ($value) use ($quantityMin, $quantityMax) {
            $quantity = $value->quantity;
            if ($quantity >= $quantityMin
             && ($quantity <= $quantityMax || ! $quantityMax)) {
                return $value;
            }
        })->values();
    }
    
    public static function filterOnRacksQuantities($commonItems, $quantityMin, $quantityMax, $racks, $rackLevels)
    {
        return $commonItems->filter(function ($value) use ($quantityMin, $quantityMax, $racks, $rackLevels) {
            $quantity = $value->quantityOnRack($racks, $rackLevels);
            if ($quantity >= $quantityMin
             && ($quantity <= $quantityMax || ! $quantityMax)
             && $quantity > 0) {
                return $value;
            }
        })->values();
    }

    public static function filterOnBrands($commonItems, $brands)
    {
        $brands = count($brands) === 0 ? Brand::pluck('id')->toArray() : $brands;
        return $commonItems->filter(function ($value) use ($brands) {
            if (in_array($value->brand->id, $brands)) {
                return $value;
            }
        })->values();
    }

    public static function filterOnCategories($commonItems, $categories)
    {
        $categories = count($categories) === 0 ? Category::pluck('id')->toArray() : $categories;
        return $commonItems->filter(function ($value) use ($categories) {
            if (in_array($value->category->id, $categories)) {
                return $value;
            }
        })->values();
    }

    public static function sortOnCategories($commonItems, $mode)
    {
        return $commonItems->sortBy([['category.name', $mode]])->values();
    }

    public static function sortOnBrands($commonItems, $mode)
    {
        return $commonItems->sortBy([['brand.name', $mode]])->values();
    }

    public static function sortOnModels($commonItems, $mode)
    {
        return $commonItems->sortBy([['model', $mode]])->values();
    }

    public static function sortOnQuantitiesOnRack($commonItems, $mode, $racksF, $rackLevelsF)
    {
        return $commonItems->sortBy(function ($commonItem) use ($mode, $racksF, $rackLevelsF) {
            if ($mode === 'asc') {
                return $commonItem->quantityOnRack($racksF, $rackLevelsF);
            }
            return - $commonItem->quantityOnRack($racksF, $rackLevelsF);
        })->values();
    }

    public static function sortOnTotalPricesOnRack($commonItems, $mode, $racksF, $rackLevelsF)
    {
        return $commonItems->sortBy(function ($commonItem) use ($mode, $racksF, $rackLevelsF) {
            if ($mode === 'asc') {
                return $commonItem->totalPriceOnRack($racksF, $rackLevelsF);
            }
            return - $commonItem->totalPriceOnRack($racksF, $rackLevelsF);
        })->values();
    }

    public static function totalQuantity()
    {
        return CommonItem::all()->sum('quantity');
    }

    public static function totalCommonItem()
    {
        return CommonItem::all()->count('id');
    }

    public static function totalFavoriteItem()
    {
        return CommonItem::where('favorite', '=', true)->get()->count();
    }

    public static function totalOutStockItem()
    {
        return CommonItem::all()->filter(function ($value) {
            if ($value->quantity <= $value->quantity_urgent) {
                return $value;
            }
        })->count();
    }
}
