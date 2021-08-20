<?php

namespace App\Http\Controllers;

use App\Events\TransactionComplete;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use App\Http\Responses\ReportResponse;
use App\Http\Traits\HasTransaction;
use App\Models\Category;
use App\Models\Inventory;
use App\Models\Sale;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class SaleController extends Controller
{
    use HasTransaction;
    public function index()
    {
        if (request()->wantsJson()) {
            return new ReportResponse(Sale::query());
        }
        return view('transactions.index', [
            'uri' => '/sales',
            'name' => 'Ventas'
        ]);
    }
    public function create()
    {
        $sale = Sale::with('client')->where('id', session('sale_id'))->first();
        $inventories = Inventory::all();
        $categories = Category::all();
        return view('sales.create', [
            'sale' => $sale ? TransactionResource::make($sale) : null,
            'inventories' => $inventories,
            'categories' => $categories
        ]);
    }



    public function store(Request $request, Sale $sale)
    {

        $fields = $request->validate([
            'status' => ['required', 'regex:/completed|cancelled|pending/'],
            'total' => 'numeric|required',
            'inventory_id' => ['required']
        ]);

        if ($fields['status'] == 'completed') {
            $factor = -1;
            request()->session()->forget('sale_id');
        }
        if ($fields['status'] == 'pending') {
            $factor = 1;
            request()->session()->put('sale_id', $sale->id);
        }
        //dd($factor);
        $sale->update($fields);
        TransactionComplete::dispatch($sale, $factor);

        

        return response()->json([
            'sale_status' => $sale->status
        ]);
    }

    public function destroy(Sale $sale)
    {
        if ($sale->status != 'completed') {
            $saleDeleted = $sale->delete();
            session()->forget('sale_id');
            return response()->json(['saleDeleted' => $saleDeleted]);
        }
        $this->deleteSessionVariable('purchase_id');
        TransactionComplete::dispatch($sale, request('factor'));
        $sale->status = 'cancelled';
        $sale->save();
        return response()->json([
            'status' => $sale->status
        ]);
    }
}
