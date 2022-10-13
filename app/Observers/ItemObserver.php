<?php

namespace App\Observers;

use App\Models\Item;

use App\Models\Category;

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
        $cat = $item->category;

        if( ! $cat->hasBrand($item->brand))
        {
            $cat->brands()->attach($item->brand_id);
        }
        
    }

    /**
     * Handle the Item "updated" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function updated(Item $item)
    {
        if ($item->getOriginal('category') != $item->category || $item->getOriginal('brand') != $item->brand) {
            
            if(Item::where('category_id', $item->getOriginal('category_id'))->where('brand_id', $item->getOriginal('brand_id'))->get()->count() == 0){
                Category::find($item->getOriginal('category_id'))->brands()->detach($item->getOriginal('brand_id'));
            }

            $cat = Category::find($item->category_id)->brands()->attach($item->brand_id);
        }
    }

    /**
     * Handle the Item "deleted" event.
     *
     * @param  \App\Models\Item  $item
     * @return void
     */
    public function deleted(Item $item)
    {
        if (Item::where('brand_id', $item->brand_id)->where('category_id', $item->category_id)->count() == 0)
        {
            $item->category->brands()->detach($item->brand_id);
        }
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
