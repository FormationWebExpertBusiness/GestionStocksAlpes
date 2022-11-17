<?php

namespace App\Exports;

use App\Models\CommonItem;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

// , ShouldQueue, FromQuery
class CommonItemExport implements FromCollection, FromQuery, WithEvents, ShouldQueue
{
    /**
     * @return \Illuminate\Support\Collection
     */
    // use Queueable, SerializesModels, Exportable;
    use Exportable;

    public function collection()
    {
        return $this->query()->get();
    }

    public function query()
    {
        return CommonItem::query()
            ->select(
                'common_items.id as cii',
                'common_items.favorite as cif',
                'brand.name as bn',
                'category.name as cn',
                'common_items.model',
                'common_items.created_at as cica',
                'common_items.updated_at as ciua',
            )
            ->join('brands as brand', 'brand.id', '=', 'common_items.brand_id')
            ->join('categories as category', 'category.id', '=', 'common_items.category_id');
    }

    public function registerEvents(): array
    {
        return [
            // Handle by a closure.
            AfterSheet::class => function (AfterSheet $event) {
            },
        ];
    }
}
