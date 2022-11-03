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
        'unit',
        'category_id',
        'brand_id',
        'model',
        'favorite',
        'photo_item',
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

    public function UnitPrice()
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

    public function ItemsOnRack(?array $rack = [], ?array $rack_level = [])
    {
        if (empty($rack) || $rack === null) {
            $rack = Rack::pluck('id')->toArray();
        }

        if (empty($rack_level) || $rack_level === null) {
            for ($i = 1; $i <= Rack::all()->max('nb_level'); $i++) {
                $rack_level[] = $i;
            }
        }

        return $this->items->filter(function ($value) use ($rack, $rack_level) {
            if (in_array($value->rack_id, $rack) && in_array($value->rack_level, $rack_level)) {
                return $value;
            }
        });
    }

    public function QuantityOnRack(?array $rack = [], ?array $rack_level = [])
    {
        return $this->ItemsOnRack($rack, $rack_level)->count();
    }

    public function TotalPriceOnRack(?array $rack = [], ?array $rack_level = [])
    {
        return $this->ItemsOnRack($rack, $rack_level)->sum('price');
    }

    public function UnitPriceOnRack(?array $rack = [], ?array $rack_level = [])
    {
        return $this->TotalPriceOnRack($rack, $rack_level) / $this->QuantityOnRack($rack, $rack_level);
    }

    public static function FilterOnQuantities($commonItems, $quantityMin, $quantityMax)
    {
        return $commonItems->filter(function ($value) use ($quantityMin, $quantityMax){
            $quantity = $value->quantity;
            if ($quantity >= $quantityMin 
             && ($quantity <= $quantityMax || ! $quantityMax)) {
                return $value;
            }
        });
    }

    public static function FilterOnRacksQuantities($commonItems, $quantityMin, $quantityMax, $racks, $rackLevels)
    {
        return $commonItems->filter(function ($value) use ($quantityMin, $quantityMax, $racks, $rackLevels) {
            $quantity = $value->QuantityOnRack($racks, $rackLevels);
            if ($quantity >= $quantityMin 
             && ($quantity <= $quantityMax || ! $quantityMax)
             && $quantity > 0) {
                return $value;
            }
        });
    }

    public static function FilterOnBrands($commonItems, $brands)
    {
        $brands = empty($brands) ? Brand::pluck('id')->toArray() : $brands;
        return $commonItems->filter(function ($value) use ($brands){
            if (in_array($value->brand->id, $brands)) {
                return $value;
            }
        });
    }

    public static function FilterOnCategories($commonItems, $categories)
    {
        $categories = empty($categories) ? Category::pluck('id')->toArray() : $categories;
        return $commonItems->filter(function ($value) use ($categories){
            if (in_array($value->category->id, $categories)) {
                return $value;
            }
        });
    }

    public static function SortOncategories($commonItems, $mode)
    {
        return $commonItems->sortBy([['category.name', $mode]]);
    }

    public static function SortOnBrands($commonItems, $mode)
    {
        return $commonItems->sortBy([['brand.name', $mode]]);
    }

    public static function SortOnModels($commonItems, $mode)
    {
        return $commonItems->sortBy([['model', $mode]]);
    }

    public static function SortOnQuantitiesOnRack($commonItems, $mode, $racksF, $rackLevelsF)
    {
        return $commonItems->sortBy(function ($commonItem) use ($mode, $racksF, $rackLevelsF) {
            if ($mode === 'asc') {
                return $commonItem->QuantityOnRack($racksF, $rackLevelsF);
            } else {
                return - $commonItem->QuantityOnRack($racksF, $rackLevelsF);
            }
        });
    }

    public static function SortOnTotalPricesOnRack($commonItems, $mode, $racksF, $rackLevelsF)
    {
        return $commonItems->sortBy(function ($commonItem) use ($mode, $racksF, $rackLevelsF) {
            if ($mode === 'asc') {
                return $commonItem->TotalPriceOnRack($racksF, $rackLevelsF);
            } else {
                return - $commonItem->TotalPriceOnRack($racksF, $rackLevelsF);
            }
        });
    }
}
