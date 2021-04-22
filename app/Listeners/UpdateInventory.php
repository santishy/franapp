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
        $inventory = Inventory::find(request('inventory_id'));
        $productsInStock = $inventory->products();
        $event->purchase->products->map(function($product) use(){
            $stock = $productsInStock->where('product_id',$product->id);
            if($stock->exists()){
                $stock->updateExistingPivot();
            }
        });
    }
}
