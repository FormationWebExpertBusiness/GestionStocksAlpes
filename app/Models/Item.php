<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = 
    [
        'quantity',
        'price',
        'currency',
        'unit',
        'category_id',
        'brand_id',
        'model',
        'comment'
    ];

    protected $with = [
        'brand',
        'category'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
