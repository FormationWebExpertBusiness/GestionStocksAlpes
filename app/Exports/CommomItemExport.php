<?php

namespace App\Exports;

use App\Models\CommonItem;
use Maatwebsite\Excel\Concerns\FromCollection;

class CommomItemExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CommonItem::where('common_items.id', '>', 0)
        ->join('brands as brand', 'brand.id', '=', 'common_items.brand_id')
        ->join('categories as category', 'category.id', '=', 'common_items.category_id')
        ->join('common_items as comi', 'comi.id', '=', 'common_items.id')->get();
    }
}
