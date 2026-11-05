<?php

namespace App\Modules\Shipping\Listeners;

use App\Modules\Orders\Events\OrderPlaced;
use Illuminate\Support\Facades\Log;

class ScheduleShipment
{
    public function handle(OrderPlaced $event): void
    {
        Log::info('Shipment scheduled', ['order' => $event->orderId]);
    }
}
