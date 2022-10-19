<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'brands';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
    ];

    protected $with = [

    ];
}
