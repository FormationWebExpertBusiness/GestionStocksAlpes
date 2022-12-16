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
}
