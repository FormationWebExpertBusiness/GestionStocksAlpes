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
}
