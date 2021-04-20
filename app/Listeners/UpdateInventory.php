<?php

namespace App\Listeners;

use App\Events\PurchaseComplete;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateInventory
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PurchaseComplete  $event
     * @return void
     */
    public function handle(PurchaseComplete $event)
    {
        $event->purchase->products->mapGroup;
    }
}
