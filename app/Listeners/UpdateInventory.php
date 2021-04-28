<?php

namespace App\Listeners;

use App\Events\PurchaseComplete;
use App\Models\Inventory;
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
        if($event->purchase->status != 'completed')
            return;
        $inventory = Inventory::find(request('inventory_id'));
        $factor = request('factor', 1); // para sumar o restar segun se tenga que actualizar
        $event->purchase->products()->get()->map(function ($product) use ($inventory,$factor) {
            $stock = $inventory->products()->where('inventory_product.product_id', $product->id);
            if ($stock->exists()) {
                $inventory->products()->updateExistingPivot(
                    $stock->first()->id,
                    ['stock' => $stock->first()->pivot->stock + ($factor * $product->pivot->qty)]
                );
            } else {
                $inventory->products()->attach($product->id, ['stock' => $product->pivot->qty]);
            }
        });
    }
}
