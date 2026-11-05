<?php

namespace App\Modules\Orders\Events;

use Illuminate\Foundation\Events\Dispatchable;

/**
 * Public: other modules react to it without Orders knowing about them.
 */
class OrderPlaced
{
    use Dispatchable;

    public function __construct(
        public readonly string $orderId,
        public readonly string $sku,
        public readonly int $quantity,
    ) {}
}
