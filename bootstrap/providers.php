<?php

use App\Modules\Catalog\CatalogServiceProvider;
use App\Modules\Shipping\ShippingServiceProvider;
use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    CatalogServiceProvider::class,
    ShippingServiceProvider::class,
];
