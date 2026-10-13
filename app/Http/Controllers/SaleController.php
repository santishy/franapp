<?php

namespace App\Http\Controllers;

use App\Events\TransactionComplete;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use App\Http\Responses\ReportResponse;
use App\Http\Traits\HasTransaction;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Sale;
use App\Models\User;
use App\Rules\CanCompleteSale;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleController extends Controller
{
    use HasTransaction;
    /**
     * @return ReportResponse|View
     */
    public function index()
    {
        $this->authorize("viewAny", new Sale());
        if (request()->wantsJson()) {
            return new ReportResponse(Sale::query());
        }
        $inventories = Inventory::all("id", "name");
        $users = User::all("id", "name");

        return view("transactions.index", [
            "uri" => "/sales",
            "inventories" => $inventories,
            "users" => $users,
            "name" => "Ventas",
        ]);
    }
    /**
     * @return View
     */
    public function create()
    {
        $this->authorize("create", new Sale());

        $sale = Sale::with("client")->where("id", session("sale_id"))->first();
        $inventories = Inventory::all();
        $categories = Category::all();
        return view("sales.create", [
            "sale" => $sale
                ? TransactionResource::make($sale->load("products"))
                : null,
            "inventories" => $inventories,
            "categories" => $categories,
        ]);
    }
    public function store(Request $request, Sale $sale)
    {
        $this->authorize("create", $sale);
        $fields = $request->validate(
            [
                "status" => [
                    "required",
                    "in:completed",
                    new CanCompleteSale($sale),
                ],
                //   "total" => "numeric|required",
                "payment_method" => "required|in:cash,card,bank_transfer",
            ],
            [
                "payment_method" => "El método de pago es obligatorio",
            ],
        );
        $fields["total"] = $sale->total();
        // ver la primera validación que hay dentro de este evento referente a status ;)
        DB::transaction(function () use ($sale, $fields, $request) {
            TransactionComplete::dispatch($sale, -1);
            $sale->update(Arr::except($fields, "payment_method"));
            $sale->payments()->create([
                "amount" => $fields["total"],
                "payment_method" => $fields["payment_method"],
                "user_id" => $request->user()->id,
            ]);
        });
        request()->session()->forget("sale_id");

        return response()->json([
            "sale_status" => $sale->status,
        ]);
    }

    public function destroy(Sale $sale): JsonResponse
    {
        $this->authorize("delete", $sale);

        if ($sale->status === "pending") {
            $saleDeleted = $sale->delete();
            session()->forget("sale_id");
            return response()->json(["saleDeleted" => $saleDeleted]);
        }
        if ($sale->status === "cancelled") {
            return response()->json(
                [
                    "message" => "La venta ya fue anulada.",
                ],
                409,
            );
        }
        DB::transaction(function () use ($sale) {
            TransactionComplete::dispatch($sale, 1);
            $sale->status = "cancelled";
            $sale->save();
        });
        $this->deleteSessionVariable("sale_id");
        return response()->json([
            "status" => $sale->status,
        ]);
    }
}
