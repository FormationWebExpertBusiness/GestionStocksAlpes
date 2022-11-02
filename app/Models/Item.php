<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getModel()
    {
        return CommonItem::find($this->common_id)->model;
    }

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public static function mostExpensiveItem()
    {
        return Item::orderby('price', 'desc')->first();
    }
}
