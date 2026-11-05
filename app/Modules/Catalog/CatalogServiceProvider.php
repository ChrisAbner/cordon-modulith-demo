<?php

namespace App\Modules\Catalog;

use App\Modules\Catalog\Contracts\ProductCatalog;
use App\Modules\Catalog\Services\EloquentProductCatalog;
use Illuminate\Support\ServiceProvider;

class CatalogServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ProductCatalog::class => EloquentProductCatalog::class,
    ];
}
