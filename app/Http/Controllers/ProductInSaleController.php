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
use App\Rules\TransactionInventory;
use Illuminate\Validation\ValidationException;

class ProductInSaleController extends Controller
{

    use HasTransaction;


    public function store(Request $request, Product $product)
    {
        $sale = Sale::getTransaction();
        $this->authorize('create', $sale);
        $request->validate(
            [
                'inventory_id' => ['required',new TransactionInventory($sale)],
            ],
        );

        Inventory::find($request->inventory_id)->existsProductInStock($product);

        $sale->transactions($product);
        $request->product = $product;
        return new TransactionResponse($sale->load('products'));
    }

    public function update(Request $request, Product $product)
    {
        $sale = Sale::find(session()->get('sale_id'));

        $this->authorize('update', $sale );

        $fields = $request->validate([
            'qty' => 'numeric|min:1',
            'sale_price' => 'numeric|min:1',
            'product_id' => 'required|exists:product_sale,product_id',
            'inventory_id' => [new TransactionInventory($sale)]
        ]);

        Inventory::find($request->inventory_id)->hasStock($product, $request->qty);

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
        /**
         * pongo el update ya que en si es actualizar la compra aun que borre elementos de la tabla pivot
         */
        $this->authorize('update',new Sale);

        if (!session()->exists('sale_id'))
            return new SessionInactive('venta');

        return response()->json([
            'data' =>  $this->deleteTransactionProduct(
                Sale::find(session()->get('sale_id')),
                $product->id
            )
        ]);
    }
}
