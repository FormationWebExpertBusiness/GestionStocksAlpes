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

    public function hasCommonProduct()
    {
        return CommonProduct::where('brand_id', $this->id)->get()->count() > 0;
    }
}
