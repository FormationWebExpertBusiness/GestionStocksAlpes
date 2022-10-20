<?php

namespace App\Models;

use App\Models\Item;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonItem extends Model
{
    use HasFactory;
    public $timestamps= true;

    protected $table = 'common_items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'unit',
        'category_id',
        'brand_id',
        'model',

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
}
