<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'items';
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
        'category',
        'model',
        'brand',
    ];

    public function getCategoryAttribute()
    {
        return CommonItem::find($this->common_id)->category;
    }

    public function getBrandAttribute()
    {
        return CommonItem::find($this->common_id)->brand;
    }

    public function getModelAttribute()
    {
        return CommonItem::find($this->common_id)->model;
    }

    public function rack() : BelongsTo
    {
        return $this->belongsTo(Rack::class);
    }

    public static function mostExpensiveItem()
    {
        return Item::orderby('price', 'desc')->first();
    }
}
