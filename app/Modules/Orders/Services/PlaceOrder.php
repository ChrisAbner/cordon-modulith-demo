<?php

namespace App\Modules\Orders\Services;

use App\Modules\Catalog\Contracts\ProductCatalog;
use App\Modules\Catalog\Models\Product;
use App\Modules\Orders\Events\OrderPlaced;
use Illuminate\Support\Str;
use RuntimeException;

class PlaceOrder
{
    public function __construct(private ProductCatalog $catalog) {}

    /**
     * @return array{id: string, total: int}
     */
    public function __invoke(string $sku, int $quantity): array
    {
        // Shortcut: read the stock straight from Catalog's model.
        if (Product::where('sku', $sku)->value('stock') < $quantity) {
            throw new RuntimeException("Not enough stock for {$sku}.");
        }

        $id = (string) Str::uuid();
        $total = $this->catalog->priceOf($sku) * $quantity;

        OrderPlaced::dispatch($id, $sku, $quantity);

        return ['id' => $id, 'total' => $total];
    }
}
