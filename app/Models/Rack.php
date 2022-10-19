<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Item;

class Rack extends Model
{
    use HasFactory;

    protected $table = 'racks';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'id',
        'nb_level'
    ];

    protected $with = [
        
    ];

    protected $appends = [
        'name'
    ];

    public function getNameAttribute()
    {
        return 'étagère ' . $this->id;
    }

    public function ItemsOn()
    {
        return Item::where('rack_id', $this->id);
    }

}
