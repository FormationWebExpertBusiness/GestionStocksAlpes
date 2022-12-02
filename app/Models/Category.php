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

    public function hasCommonProduct()
    {
        return CommonProduct::where('category_id', $this->id)->get()->count() > 0;
    }

    public static function getLinkedBrands($catsFilter)
    {
        $brands = collect();

        if (count($catsFilter) === 0) {
            $brands = Brand::all();
        } else {
            foreach ($catsFilter as $cat) {
                $brands = $brands->merge(Category::find($cat)->brands);
            }
            $brands->unique();
            $brands->sortBy('id');
        }

        return $brands;
    }
}
