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
        'nb_level',
    ];

    protected $with = [

    ];

    protected $appends = [
        'name',
        'qrcodesLinks',
    ];

    public function getNameAttribute()
    {
        return 'Étagère ' . $this->id;
    }

    public function getQrcodesLinksAttribute()
    {
        $qrcodes = [];
        for ($level = 1; $level <= $this->nb_level; $level++) {
            $qrcodes[$level] = 'public/code-qr/rack-'.$this->id.'_lvl-'.$level.'.svg';
        }
        return $qrcodes;
    }

    public function dataInQrcode($level)
    {
        return '{"rack_id":'.$this->id.', "rack_level":'.$level.'}';
    }

    public function itemsOn()
    {
        return Item::where('rack_id', $this->id)->get();
    }

    public function itemsOnLevel($level)
    {
        return Item::where('rack_id', $this->id)->where('rack_level', $level)->get();
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
