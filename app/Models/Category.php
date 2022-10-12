<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name'
    ];

    protected $with = [
        'brands'
    ];

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brands_categories', 'category_id', 'brand_id');
    }

    public function hasBrand($brand)
    {
        return $this->brands->contains($brand);
    }
}
