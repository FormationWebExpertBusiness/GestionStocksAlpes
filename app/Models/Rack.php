<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rack extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'racks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
    ];

    protected $with = [

    ];

    public function ItemsOn()
    {
        return Item::where('rack_id', $this->id);
    }
}
