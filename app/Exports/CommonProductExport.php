<?php

namespace App\Exports;

use App\Models\CommonProduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

// , ShouldQueue, FromQuery
class CommonProductExport implements FromCollection, FromQuery, WithEvents, ShouldQueue
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
        return CommonProduct::query()
            ->select(
                'common_products.id as cii',
                'common_products.favorite as cif',
                'brand.name as bn',
                'category.name as cn',
                'common_products.model',
                'common_products.created_at as cica',
                'common_products.updated_at as ciua',
            )
            ->join('brands as brand', 'brand.id', '=', 'common_products.brand_id')
            ->join('categories as category', 'category.id', '=', 'common_products.category_id');
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
