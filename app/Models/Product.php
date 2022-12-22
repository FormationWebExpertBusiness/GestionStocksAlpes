<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;

    public $mobileUser;

    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'serial_number',
        'price',
        'currency',
        'comment',
        'rack_id',
        'rack_level',
        'common_id',
    ];

    protected $with = [
        'rack',
    ];

    protected $appends = [

    ];

    public function getCategory()
    {
        return CommonProduct::find($this->common_id)->category;
    }

    public function getBrand()
    {
        return CommonProduct::find($this->common_id)->brand;
    }

    public function getModel()
    {
        return CommonProduct::find($this->common_id)->model;
    }

    public function rack(): BelongsTo
    {
        return $this->belongsTo(Rack::class);
    }

    public static function mostExpensiveProduct()
    {
        return Product::orderby('price', 'desc')->first();
    }

    public static function sortOnCreatedAt($products, $mode)
    {
        return $products->sortBy([['id', $mode]])->values();
    }
    public static function sortOnCategories($products, $mode)
    {
        $sorted = $products->sortBy(function ($product) {
            return $product->getCategory()->name;
        });
        if ($mode === 'desc') {
            $sorted = $sorted->reverse();
        }
        return $sorted->values();
    }
    public static function sortOnBrands($products, $mode)
    {
        $sorted = $products->sortBy(function ($product) {
            return $product->getBrand()->name;
        });
        if ($mode === 'desc') {
            $sorted = $sorted->reverse();
        }
        return $sorted->values();
    }
    public static function sortOnModels($products, $mode)
    {
        $sorted = $products->sortBy(function ($product) {
            return $product->getModel();
        });
        if ($mode === 'desc') {
            $sorted = $sorted->reverse();
        }
        return $sorted->values();
    }
    public static function sortOnSerialNumbers($products, $mode)
    {
        return $products->sortBy([['serial_number', $mode]])->values();
    }
    public static function sortOnRacks($products, $mode)
    {
        $sorted = null;
        if ($mode === 'desc') {
            $sorted = $products->sortBy([
                fn ($a, $b) => $a->rack_level <=> $b->rack_level,
                fn ($a, $b) => $a->rack->name <=> $b->rack->name,
            ]);
        } else {
            $sorted = $products->sortBy([
                fn ($a, $b) => $b->rack_level <=> $a->rack_level,
                fn ($a, $b) => $b->rack->name <=> $a->rack->name,
            ]);
        }
        return $sorted->values();
    }
    public static function sortOnPrices($products, $mode)
    {
        return $products->sortBy([['price', $mode]])->values();
    }

    public static function filterOnBrands($products, $brands)
    {
        $brands = count($brands) === 0 ? Brand::pluck('id')->toArray() : $brands;
        return $products->filter(function ($value) use ($brands) {
            if (in_array($value->getBrand()->id, $brands)) {
                return $value;
            }
        })->values();
    }

    public static function filterOnCategories($products, $categories)
    {
        $categories = count($categories) === 0 ? Category::pluck('id')->toArray() : $categories;
        return $products->filter(function ($value) use ($categories) {
            if (in_array($value->getCategory()->id, $categories)) {
                return $value;
            }
        })->values();
    }

    public static function filterOnCommonProduct($products, $commonProducts)
    {
        $commonProducts = count($commonProducts) === 0 ? CommonProduct::pluck('id')->toArray() : $commonProducts;
        return $products->filter(function ($value) use ($commonProducts) {
            if (in_array($value->common_id, $commonProducts)) {
                return $value;
            }
        })->values();
    }

    public static function filterOnRack($products, $racks)
    {
        $racks = count($racks) === 0 ? Rack::pluck('id')->toArray() : $racks;
        return $products->filter(function ($value) use ($racks) {
            if (in_array($value->getCategory()->id, $racks)) {
                return $value;
            }
        })->values();
    }

    public static function filterOnRackLevel($products, $rackLevels)
    {
        if (count($rackLevels) === 0) {
            $levelMax = Rack::getRackLevelMax();
    
            $rackLevels = [];
            for ($i = 1; $i <= $levelMax; $i++) {
                $rackLevels[] = $i;
            }
        }
        return $products->filter(function ($value) use ($rackLevels) {
            if (in_array($value->rack_id, $rackLevels)) {
                return $value;
            }
        })->values();
    }
}
