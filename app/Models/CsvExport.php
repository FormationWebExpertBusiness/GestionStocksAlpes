<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CsvExport extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'csv_export';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'user_id',
    ];
}
