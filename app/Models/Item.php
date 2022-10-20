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
        'price',
        'currency',
        'comment',
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
}
