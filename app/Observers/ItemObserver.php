<?php

namespace App\Observers;

use App\Models\CommonItem;
use App\Models\HistoryItem;
use App\Models\Item;

class ItemObserver
{
    /**
     * Handle the Item "created" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function created(Item $item)
    {
        $commonItem = CommonItem::find($item->common_id);

        HistoryItem::create([
            'code_action' => 'C',
            'category' => $commonItem->category->name,
            'brand' => $commonItem->brand->name,
            'model' => $commonItem->model,
            'serial_number' => $item->serial_number,
            'price' => $item->price,
            'comment' => $item->comment,
        ]);
    }

    /**
     * Handle the Item "updated" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function updated(Item $item)
    {
        
    }

    /**
     * Handle the Item "deleted" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function deleted(Item $item)
    {
        $commonItem = CommonItem::find($item->common_id);

        HistoryItem::create([
            'category' => $commonItem->category->name,
            'code_action' => 'D',
            'brand' => $commonItem->brand->name,
            'model' => $commonItem->model,
            'serial_number' => $item->serial_number,
            'price' => $item->price,
            'comment' => $item->comment,
        ]);
    }

    /**
     * Handle the Item "restored" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function restored(Item $item)
    {
        //
    }

    /**
     * Handle the Item "force deleted" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function forceDeleted(Item $item)
    {
        //
    }
}
