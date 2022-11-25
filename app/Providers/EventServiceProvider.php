<?php

namespace App\Providers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonItem;
use App\Models\Item;
use App\Models\Rack;
use App\Observers\BrandObserver;
use App\Observers\CategoryObserver;
use App\Observers\CommonItemObserver;
use App\Observers\ItemObserver;
use App\Observers\RackObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    protected $observers = [
        Item::class => [ItemObserver::class],
        CommonItem::class => [CommonItemObserver::class],
        Brand::class => [BrandObserver::class],
        Category::class => [CategoryObserver::class],
        Rack::class => [RackObserver::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
