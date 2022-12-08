<?php

namespace App\Observers;

use App\Models\CommonProduct;

use App\Models\Category;

use Illuminate\Support\Facades\Storage;

class CommonProductObserver
{
    /**
     * Handle the CommonProduct "created" event.
     *
     * @param  \App\Models\CommonProduct  $commonProduct
     * @return void
     */
    public function created(CommonProduct $commonProduct)
    {
        $cat = $commonProduct->category;

        if( ! $cat->hasBrand($commonProduct->brand))
        {
            $cat->brands()->attach($commonProduct->brand_id);
        }

        $commonProduct->UpdateStatusQuantity();
    }

    /**
     * Handle the CommonProduct "updated" event.
     *
     * @param  \App\Models\CommonProduct  $commonProduct
     * @return void
     */
    public function updated(CommonProduct $commonProduct)
    {
        if ($commonProduct->photo_product !== $commonProduct->getOriginal('photo_product') && $commonProduct->getOriginal('photo_product')) {
            Storage::delete($commonProduct->getOriginal('photo_product'));
        }

        if ($commonProduct->getOriginal('category') != $commonProduct->category || $commonProduct->getOriginal('brand') != $commonProduct->brand) {
            
            if(CommonProduct::where('category_id', $commonProduct->getOriginal('category_id'))->where('brand_id', $commonProduct->getOriginal('brand_id'))->get()->count() == 0){
                Category::find($commonProduct->getOriginal('category_id'))->brands()->detach($commonProduct->getOriginal('brand_id'));
            }

            $cat = Category::find($commonProduct->category_id)->brands()->syncWithoutDetaching([$commonProduct->brand_id]);
        }
        
        if (array_key_exists('quantity_low',$commonProduct->getChanges()) || array_key_exists('quantity_critical', $commonProduct->getChanges())) {
            $commonProduct->UpdateStatusQuantity();
        }
    }

    /**
     * Handle the CommonProduct "deleted" event.
     *
     * @param  \App\Models\CommonProduct  $commonProduct
     * @return void
     */
    public function deleted(CommonProduct $commonProduct)
    {
        if ($commonProduct->getOriginal('photo_product')) {
            Storage::delete($commonProduct->photo_product);
        }

        if (CommonProduct::where('brand_id', $commonProduct->brand_id)->where('category_id', $commonProduct->category_id)->count() == 0)
        {
            $commonProduct->category->brands()->detach($commonProduct->brand_id);
        }
    }

    /**
     * Handle the CommonProduct "deleting" event.
     *
     * @param  \App\Models\CommonProduct  $commonProduct
     * @return void
     */
    public function deleting(CommonProduct $commonProduct)
    {
        foreach ($commonProduct->products as $product) {
            $product->delete();
        }
    }

    /**
     * Handle the CommonProduct "restored" event.
     *
     * @param  \App\Models\CommonProduct  $commonProduct
     * @return void
     */
    public function restored(CommonProduct $commonProduct)
    {
        //
    }

    /**
     * Handle the CommonProduct "force deleted" event.
     *
     * @param  \App\Models\CommonProduct  $commonProduct
     * @return void
     */
    public function forceDeleted(CommonProduct $commonProduct)
    {
        //
    }
}
