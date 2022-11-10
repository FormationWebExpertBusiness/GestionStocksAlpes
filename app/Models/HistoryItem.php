<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryItem extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'history_items';
    protected $primaryKey = 'id';

    protected $fillable = [
        'code_action',
        'category',
        'brand',
        'model',
        'serial_number',
        'price',
        'comment',
    ];

    public static function oldestDate()
    {
        return HistoryItem::selectRaw('DATE_FORMAT(MIN(created_at),"%Y-%m-%d") as oldest_date')->first()->oldest_date;
    }

    public static function newestDate()
    {
        return HistoryItem::selectRaw('DATE_FORMAT(MAX(created_at),"%Y-%m-%d") as newest_date')->first()->newest_date;
    }

    public static function getAllBrands()
    {
        return HistoryItem::select('history_items.brand')->distinct()->get()->pluck(['brand'])->all();
    }

    public static function getAllCategories()
    {
        return HistoryItem::select('history_items.category')->distinct()->get()->pluck(['category'])->all();
    }

    public static function filterOnBrands($historyItems, $brands)
    {
        if (count($brands) !== 0) {//filter
            return $historyItems->filter(function ($value) use ($brands) {
                if (in_array($value->brand, $brands)) {
                    return $value;
                }
            });
        } else {//no need to filter
            return $historyItems;
        }
    }

    public static function filterOnCategories($historyItems, $categories)
    {
        if (count($categories) !== 0) {//filter
            return $historyItems->filter(function ($value) use ($categories) {
                if (in_array($value->category, $categories)) {
                    return $value;
                }
            });
        } else {//no need to filter
            return $historyItems;
        }
    }

    public static function filterOnMovedAfter($historyItems, $dateFrom)
    {
        if ($dateFrom) {//filter
            return $historyItems->filter(function ($value) use ($dateFrom) {
                // dump($value->created_at->format('d/m/Y'),'>=', $dateFrom);
                if ($value->created_at->format('Y-m-d') >= $dateFrom) {
                    // dump('ok');
                    return $value;
                }
            });
        } else {//no need to filter
            return $historyItems;
        }
    }

    public static function filterOnMovedBefore($historyItems, $dateTo)
    {
        if ($dateTo) {//filter
            return $historyItems->filter(function ($value) use ($dateTo) {
                // dump($value->created_at->format('d/m/Y'),'<=', $dateTo);
                if ($value->created_at->format('Y-m-d') <= $dateTo) {
                    // dump('ok');
                    return $value;
                }
            });
        } else {//no need to filter
            return $historyItems;
        }
    }
}
