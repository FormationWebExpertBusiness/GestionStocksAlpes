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
}
