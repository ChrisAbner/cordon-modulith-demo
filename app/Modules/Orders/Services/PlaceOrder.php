<?php

namespace App\Modules\Orders\Services;

use App\Modules\Catalog\Contracts\ProductCatalog;
use App\Modules\Orders\Events\OrderPlaced;
use Illuminate\Support\Str;

class PlaceOrder
{
    public function __construct(private ProductCatalog $catalog) {}

    /**
     * @return array{id: string, total: int}
     */
    public function __invoke(string $sku, int $quantity): array
    {
        $id = (string) Str::uuid();
        $total = $this->catalog->priceOf($sku) * $quantity;

        OrderPlaced::dispatch($id, $sku, $quantity);

        return ['id' => $id, 'total' => $total];
    }
}
