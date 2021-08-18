<?php

namespace App\Listeners;

use App\Events\TransactionComplete;
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
     * @param  TransactionComplete  $event
     * @return void
     */
    public function handle(TransactionComplete $event)
    {

        if ($event->transaction->status != 'completed')
            return;

        $inventory = Inventory::find(request('inventory_id'));
        $factor = $event->factor; // para sumar o restar segun se tenga que actualizar

        $event->transaction->products()->get()->map(function ($product) use ($inventory, $factor) {

            $stock = $inventory->products()->where('inventory_product.product_id', $product->id);

            if ($stock->exists()) {
                if ($factor == -1) {
                    //dd('entro aki: '.$product->pivot->qty);
                    $inventory->hasStock($product, $product->pivot->qty);
                }
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
