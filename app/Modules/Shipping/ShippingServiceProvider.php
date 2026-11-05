<?php

namespace App\Modules\Shipping;

use App\Modules\Orders\Events\OrderPlaced;
use App\Modules\Shipping\Listeners\ScheduleShipment;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class ShippingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Event::listen(OrderPlaced::class, ScheduleShipment::class);
    }
}
