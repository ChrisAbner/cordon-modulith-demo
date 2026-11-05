<?php

namespace App\Modules\Catalog\Contracts;

/**
 * What other modules may ask the catalog. Public: it lives in Contracts.
 */
interface ProductCatalog
{
    /**
     * Price in cents.
     */
    public function priceOf(string $sku): int;
}
