<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Resources\ProductResource;
use App\Http\Responses\SessionInactive;
use App\Http\Responses\TransactionResponse;
use App\Http\Traits\HasTransaction;
use App\Models\Inventory;
use App\Rules\Stock;

class ProductInSaleController extends Controller
{

    use HasTransaction;


    public function store(Request $request, Product $product)
    {

        $request->validate(
            [
              //  'salePriceOption' => ['required', 'regex:/retail_price|wholesale_price/'],
                'inventory_id' => ['required'],
            ],
            [
              //  'salePriceOption.required' => 'Debes elegir un precio de venta antes de comenzar'
            ]
        );

        Inventory::find($request->inventory_id)->hasStock($product);

        $sale = Sale::getTransaction();
        $sale->transactions($product);
        $request->product = $product;
        return new TransactionResponse($sale);
    }

    public function update(Request $request, Product $product)
    {
        $fields = $request->validate([
            'qty' => 'numeric|required|min:1',
            'sale_price' => 'numeric|required|min:1',
            'product_id' => 'required|exists:product_sale,product_id'
        ]);

        Inventory::find($request->inventory_id)->hasStock($product, $request->qty);

        $sale = Sale::find(session()->get('sale_id'));

        $sale->products()
            ->updateExistingPivot(
                $request->product_id,
                $request->except('product_id', '_method', 'inventory_id')
            );

        return response()->json(
            $request->except('_method')
        );
    }

    public function destroy(Product $product)
    {

        if (!session()->exists('sale_id'))
            return new SessionInactive('venta');


        return response()->json([
            'data' =>  $this->deleteTransactionProduct(Sale::find(session()->get('sale_id')), $product->id)
        ]);
    }
}
