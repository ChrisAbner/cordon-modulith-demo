<?php

namespace App\Modules\Catalog\Services;

use App\Modules\Catalog\Contracts\ProductCatalog;
use App\Modules\Catalog\Models\Product;

class EloquentProductCatalog implements ProductCatalog
{
    public function priceOf(string $sku): int
    {
        return Product::where('sku', $sku)->value('price');
    }
}
