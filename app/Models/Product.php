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
    
            $rackLevels = collect();
            for ($i = 1; $i <= $levelMax; $i++) {
                $rackLevels->push($i);
            }
        }
        return $products->filter(function ($value) use ($rackLevels) {
            if (in_array($value->rack_id, $rackLevels)) {
                return $value;
            }
        })->values();
    }
}
