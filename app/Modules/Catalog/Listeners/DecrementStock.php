<?php

namespace App\Modules\Catalog\Listeners;

use App\Modules\Catalog\Models\Product;
use App\Modules\Orders\Events\OrderPlaced;

class DecrementStock
{
    public function handle(OrderPlaced $event): void
    {
        Product::where('sku', $event->sku)->decrement('stock', $event->quantity);
    }
}
