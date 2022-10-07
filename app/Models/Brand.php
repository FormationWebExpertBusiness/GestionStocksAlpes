<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name'
    ];

    protected $with = [
        'items',
        'categories'
    ];

    public function items()
    {
        return $this->hasMany(Item::class, 'brand_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'brands_categories', 'brand_id', 'category_id');
    }
}
