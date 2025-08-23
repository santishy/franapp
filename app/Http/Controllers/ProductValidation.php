<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductValidation extends Controller
{

    public function skuAvailability(Request $request)
    {
        $sku = trim((string) $request->input('sku'));
        $ignoreId = $request->input('ignore_id', null);
        $rule = Rule::unique('products', 'sku');
        if ($ignoreId) {
            $rule->ignore($ignoreId);
        }
        $validator = validator(['sku' => $sku], [
            'sku' => $rule,
        ], [
            'sku.unique' => 'El sku ingresado ya está en uso. Por favor, elija otro.'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'available' => false,
                'message' => $validator->errors()->first('sku')
            ], 422);
        }
        return response()->json([
            'available' => true,
            'message' => 'El sku está disponible.'
        ]);
    }
}
