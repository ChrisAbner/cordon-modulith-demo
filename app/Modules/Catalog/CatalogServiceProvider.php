<?php

namespace App\Modules\Catalog;

use App\Modules\Catalog\Contracts\ProductCatalog;
use App\Modules\Catalog\Listeners\DecrementStock;
use App\Modules\Catalog\Services\EloquentProductCatalog;
use App\Modules\Orders\Events\OrderPlaced;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProductCatalog::class => EloquentProductCatalog::class,
    ];

    public function boot(): void
    {
        Event::listen(OrderPlaced::class, DecrementStock::class);
    }
}
