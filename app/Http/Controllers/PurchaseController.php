<?php

namespace App\Http\Controllers;

use App\Http\Resources\PurchaseResource;
use App\Http\Resources\TransactionResource;
use App\Http\Traits\HasTransaction;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    use HasTransaction;
    public function index()
    {
        if (request()->wantsJson()) {
            return response()->json([
                'data' =>
                TransactionResource::collection(Purchase::with('products')->applyFilters()->get())
            ]);
        }
        return view('transactions.index',['uri' => '/purchases']);
    }
    /*FALTA VALIDAR QUE EL PRODUCTO NO SE REPITA EN LA MISMA COMPRA!!!  PUEDE AGREGARSE OTRO AL DARLE DOBLE CLICK ;) */
    public function store(Request $request)
    {
        request()->validate(
            [
                'product_id' => 'exists:products,id'
            ]
        );
        $purchase = Purchase::findOrCreateThePurchase();
        $productInPurchase = $purchase->products()->where(['product_id' => $request->product_id]);
        if ($productInPurchase->exists()) {
            $productInPurchase->updateExistingPivot($request->product_id, ['qty' => ($productInPurchase->first()->pivot->qty + 1)]);
        } else {
            $purchase->products()->attach($request->product_id, [
                'purchase_price' => $request->purchase_price,
                'qty' => 1
            ]);
        }
        return response()->json([
            'qty' => $purchase->products()->where('product_id', $request->product_id)->sum('qty'),
            'purchase_id' => $purchase->id,
        ]);
    }

    public function show(Purchase $purchase)
    {
        $productsInPurchase = $purchase->products()->get();
        $totalPurchase = $purchase->totalPurchase();
        return view('purchases.show')
            ->with(compact('productsInPurchase'))
            ->with(compact('totalPurchase'))
            ->with(compact('purchase'));
    }
    public function edit(Purchase $purchase)
    {
    }
    public function update(Request $request,Purchase $purchase)
    {
        if($request->status === 'completed')
            $this->deleteSessionVariable('purchase_id');
            
        $purchase->update($request->all());
        return new PurchaseResource($purchase);
    }
    public function destroy(Purchase $purchase)
    {
        $this->deleteSessionVariable('purchase_id');
        return response()->json([
            'delete' => $purchase->delete()
        ]);
    }
}
