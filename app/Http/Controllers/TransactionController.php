<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use app\Models\Purchase;
use app\Models\Sale;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        
        $request->validate([
            'transactionType' => ['required','regex:/sale|purchase/'],
            'id' => ['required']
        ]);

        $model = str::of(request('transactionType'))->ucfirst();

        $model = app("App\\Models\\{$model}");

        $instance = $model->find($request->id)->load('products');
        

        return response()->json(['instance' => $instance]);
    }
}
