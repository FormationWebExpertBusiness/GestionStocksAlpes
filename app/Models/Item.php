<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'items';
    protected $primaryKey = 'id';

    protected $fillable =
    [
        'quantity',
        'price',
        'currency',
        'unit',
        'category_id',
        'brand_id',
        'model',
        'comment',
        'rack_level',
    ];

    protected $with = [
        'brand',
        'category',
        'rack',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public static function total()
    {
        return Item::all()->count('id');
    }

    public static function quantity()
    {
        return Item::all()->sum('quantity');
    }

    public static function price()
    {
        return Item::orderby('price','desc')->first();
    }


}
