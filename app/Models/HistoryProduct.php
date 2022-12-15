<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryProduct extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'history_products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code_action',
        'category',
        'brand',
        'model',
        'serial_number',
        'price',
        'user_id',
        'comment',
    ];

    protected $with = [
        'user',
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public static function oldestDate()
    {
        return date('Y-m-d', strtotime(HistoryProduct::selectRaw('MIN(created_at) as oldest_date')->first()->oldest_date));
    }

    public static function newestDate()
    {
        return date('Y-m-d', strtotime(HistoryProduct::selectRaw('MAX(created_at) as newest_date')->first()->newest_date));
    }

    public static function getAllBrands()
    {
        return HistoryProduct::select('history_products.brand')->distinct()->get()->pluck(['brand'])->all();
    }

    public static function getAllCategories()
    {
        return HistoryProduct::select('history_products.category')->distinct()->get()->pluck(['category'])->all();
    }

    public static function filterOnBrands($historyProducts, $brands)
    {
        if (count($brands) !== 0) {//filter
            return $historyProducts->filter(function ($value) use ($brands) {
                if (in_array($value->brand, $brands)) {
                    return $value;
                }
            });
        } else {//no need to filter
            return $historyProducts;
        }
    }

    public static function filterOnCategories($historyProducts, $categories)
    {
        if (count($categories) !== 0) {//filter
            return $historyProducts->filter(function ($value) use ($categories) {
                if (in_array($value->category, $categories)) {
                    return $value;
                }
            });
        } else {//no need to filter
            return $historyProducts;
        }
    }

    public static function filterOnMovedAfter($historyProducts, $dateFrom)
    {
        if ($dateFrom) {//filter
            return $historyProducts->filter(function ($value) use ($dateFrom) {
                if ($value->created_at->format('Y-m-d') >= $dateFrom) {
                    return $value;
                }
            });
        } else {//no need to filter
            return $historyProducts;
        }
    }

    public static function filterOnMovedBefore($historyProducts, $dateTo)
    {
        if ($dateTo) {//filter
            return $historyProducts->filter(function ($value) use ($dateTo) {
                if ($value->created_at->format('Y-m-d') <= $dateTo) {
                    return $value;
                }
            });
        } else {//no need to filter
            return $historyProducts;
        }
    }
}
