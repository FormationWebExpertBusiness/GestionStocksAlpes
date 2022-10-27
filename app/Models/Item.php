<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function rack()
    {
        return $this->belongsTo(Rack::class);
    }

    public static function total()
    {
        return Item::all()->count('id');
    }

    public static function quantity()
    {
        return Item::all()->sum('quantity');
    }

    public static function price()
    {
        return Item::orderby('price','desc')->first();
    }


}
