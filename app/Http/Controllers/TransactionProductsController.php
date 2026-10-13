<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleReturn;
use Illuminate\Validation\Rule;

class TransactionProductsController extends Controller
{
    public function index(Request $request)
    {
        $models = [
            "sale" => Sale::class,
            "purchase" => Purchase::class,
            "return" => SaleReturn::class,
        ];
        $request->validate([
            "transactionType" => ["required", Rule::in(array_keys($models))],
            "id" => ["required"],
        ]);

        $model = $models[$request->transactionType]::findOrFail($request->id);
        //Str::of(request("transactionType"))->ucfirst();

        //$model = app("App\\Models\\{$model}");

        return response()->json([
            "products" => ProductResource::collection(
                $model->products()->paginate(25),
            ),
        ]);
    }
}
