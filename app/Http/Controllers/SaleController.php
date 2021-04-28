<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Resources\TransactionResource;
use App\Http\Responses\ReportResponse;
use App\Models\Inventory;
use App\Models\Sale;
use Facade\Ignition\QueryRecorder\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

class SaleController extends Controller
{
    public function index()
    {
        if (request()->wantsJson()) {
            return new ReportResponse(Sale::query());
        }
        return view('transactions.index',[
            'uri' => '/sales',
            'name' => 'Ventas'
        ]);
    }
    public function create()
    {
        $sale = Sale::find(session()->get('sale_id'));
        $inventories = Inventory::all();
        return view('sales.create', [
            'sale' => $sale ? TransactionResource::make($sale) : null,
            'inventories' => $inventories
        ]);
    }



    public function store(Request $request, Sale $sale)
    {
        $fields = $request->validate([
            'status' => ['required', 'regex:/completed|cancelled|pending/'],
            'total' => 'numeric|required',
            'phone_number' => 'exists:clients,phone_number|required'
        ]);
        if ($fields['status'] === 'completed')
            request()->session()->forget('sale_id');
        else
            request()->session()->put('sale_id', $sale->id);
        $sale->update($fields);
        $sale->client()
            ->associate(
                Client::where(
                    'phone_number',
                    $fields['phone_number']
                )->first()
            );
        $sale->save();
        return response()->json([
            'sale_status' => $sale->status
        ]);
    }
}
