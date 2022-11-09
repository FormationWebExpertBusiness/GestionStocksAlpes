<?php

namespace App\Observers;

use App\Models\CommonItem;

use App\Models\Category;

use Illuminate\Support\Facades\Storage;

class CommonItemObserver
{
    /**
     * Handle the CommonItem "created" event.
     *
     * @param  \App\Models\CommonItem  $commonItem
     * @return void
     */
    public function created(CommonItem $commonItem)
    {
        $cat = $commonItem->category;

        if( ! $cat->hasBrand($commonItem->brand))
        {
            $cat->brands()->attach($commonItem->brand_id);
        }
    }

    /**
     * Handle the CommonItem "updated" event.
     *
     * @param  \App\Models\CommonItem  $commonItem
     * @return void
     */
    public function updated(CommonItem $commonItem)
    {
        if ($commonItem->photo_item !== $commonItem->getOriginal('photo_item') && $commonItem->getOriginal('photo_item')) {
            Storage::delete($commonItem->getOriginal('photo_item'));
        }

        if ($commonItem->getOriginal('category') != $commonItem->category || $commonItem->getOriginal('brand') != $commonItem->brand) {
            
            if(CommonItem::where('category_id', $commonItem->getOriginal('category_id'))->where('brand_id', $commonItem->getOriginal('brand_id'))->get()->count() == 0){
                Category::find($commonItem->getOriginal('category_id'))->brands()->detach($commonItem->getOriginal('brand_id'));
            }

            $cat = Category::find($commonItem->category_id)->brands()->syncWithoutDetaching([$commonItem->brand_id]);
        }
    }

    /**
     * Handle the CommonItem "deleted" event.
     *
     * @param  \App\Models\CommonItem  $commonItem
     * @return void
     */
    public function deleted(CommonItem $commonItem)
    {
        if ($commonItem->getOriginal('photo_item')) {
            Storage::delete($commonItem->photo_item);
        }

        if (CommonItem::where('brand_id', $commonItem->brand_id)->where('category_id', $commonItem->category_id)->count() == 0)
        {
            $commonItem->category->brands()->detach($commonItem->brand_id);
        }
    }

    /**
     * Handle the CommonItem "deleting" event.
     *
     * @param  \App\Models\CommonItem  $commonItem
     * @return void
     */
    public function deleting(CommonItem $commonItem)
    {
        foreach ($commonItem->items as $item) {
            $item->delete();
        }
    }

    /**
     * Handle the CommonItem "restored" event.
     *
     * @param  \App\Models\CommonItem  $commonItem
     * @return void
     */
    public function restored(CommonItem $commonItem)
    {
        //
    }

    /**
     * Handle the CommonItem "force deleted" event.
     *
     * @param  \App\Models\CommonItem  $commonItem
     * @return void
     */
    public function forceDeleted(CommonItem $commonItem)
    {
        //
    }
}
