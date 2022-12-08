<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Rack extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $table = 'racks';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'name',
        'nb_level',
    ];

    protected $with = [

    ];

    protected $appends = [

    ];

    public function getQrcode($level)
    {
        return QrCode::format('svg')->generate($this->dataInQrcode($level));
    }

    public function dataInQrcode($level)
    {
        return '{"rack_id":'.$this->id.', "rack_level":'.$level.'}';
    }

    public function productsOn()
    {
        return Product::where('rack_id', $this->id)->get();
    }

    public function productsOnLevel($level)
    {
        return Product::where('rack_id', $this->id)->where('rack_level', $level)->get();
    }

    public static function getRackLevelMax(array $racks = [])
    {
        $max = 0;
        if (count($racks) === 0) {
            $allNbLevels = Rack::pluck('nb_level')->toArray();
            $max = max($allNbLevels);
        } else {
            foreach ($racks as $rack) {
                if (Rack::find($rack)->nb_level > $max) {
                    $max = Rack::find($rack)->nb_level;
                }
            }
        }
        return $max;
    }
}
