<?php

namespace App\Http\Controllers;

use App\Events\TransactionComplete;
use App\Facades\InventoryContext;
use App\Http\Requests\StoreSaleReturnRequest;
use App\Http\Requests\UpdateSaleReturnRequest;
use App\Http\Resources\SaleReturnResource;
use App\Http\Responses\ReportResponse;
use App\Models\Inventory;
use App\Models\Sale;
use App\Models\SaleReturn;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SaleReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize("viewAny", new SaleReturn());
        if (request()->wantsJson()) {
            return new ReportResponse(
                SaleReturn::query(),
                SaleReturnResource::class,
            );
        }
        $inventories = Inventory::all("id", "name");
        $users = User::all("id", "name");

        return view("returns.index", [
            "uri" => "/returns",
            "inventories" => $inventories,
            "users" => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Sale $sale)
    {
        $sale->load("products", "client");
        $sale->products->transform(function ($product) use ($sale) {
            $product->returnableQty = $sale->returnableQty($product->id);
            return $product;
        });
        //verificar que hace el resource de sale
        return view("returns.create", ["sale" => $sale]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Sale $sale, StoreSaleReturnRequest $request)
    {
        $this->authorize("create", new SaleReturn());

        $saleReturn = DB::transaction(function () use ($sale, $request) {
            $saleReturn = SaleReturn::create([
                "original_sale_id" => $sale->id,
                "user_id" => $request->user()->id,
                "inventory_id" => $sale->inventory_id,
                "resolution" => $request->resolution,
            ]);

            $sale->loadMissing("products");

            $items = collect($request->products)->mapWithKeys(
                fn($item) => [
                    $item["product_id"] => [
                        "qty" => $item["qty"],
                        "return_price" => $sale->products->find(
                            $item["product_id"],
                        )->pivot->sale_price,
                    ],
                ],
            );
            $total = $items->sum(
                fn($item) => $item["qty"] * $item["return_price"],
            );
            $saleReturn->total = $total;
            $saleReturn->save();
            $saleReturn->products()->attach($items);
            TransactionComplete::dispatch($saleReturn, 1);
            $saleReturn->payments()->create([
                "amount" => $total,
                "payment_method" => $request->payment_method,
                "user_id" => $request->user()->id,
                "direction" => "refund",
            ]);

            return $saleReturn;
        });
        return response()->json(["data" => $saleReturn], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleReturn $saleReturn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateSaleReturnRequest $request,
        SaleReturn $saleReturn,
    ) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleReturn $saleReturn)
    {
        //
    }
}
