<?php 

namespace App\JsonApi;

class JsonApiBuilder{

    public function applyFilters(){
        return function(){
            foreach(request('filter',[]) as $filter => $value){
                $this->{$filter}($value);
            }
            return $this;
        };
    }

    // public function transactions($model){
    //     $model = $model::find(session()->get('purchase_id'));
    //     $model->products()->updateExistingPivot(request()->id,[
    //         'qty' => request()->pivot['qty'],
    //         'purchase_price' => request()->pivot['purchase_price']
    //     ]);
    //     return response()->json([
    //         'totalPurchase' => request()->totalPurchase(),
    //     ]);
    // }
}