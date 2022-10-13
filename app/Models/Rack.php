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
        'id'
    ];

    protected $with = [
        
    ];

    public function ItemsOn()
    {
        return Item::where('rack_id', $this->id);
    }

}
