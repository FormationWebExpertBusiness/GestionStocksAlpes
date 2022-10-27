<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
    ];

    protected $with = [
        'brands',
    ];

    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brands_categories', 'category_id', 'brand_id');
    }

    public function hasBrand($brand)
    {
        return $this->brands->contains($brand);
    }

    public function hasCommonItem()
    {
        return CommonItem::where('category_id', $this->id)->get()->count() > 0;
    }
}
