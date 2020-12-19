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

    public function transactions(){

        return function(){
            $transaction = $this->findOrCreateTheTransaction();
            $products = $transaction
                ->products()
                ->where(['product_id' => request()->product_id]);
            if ($products->exists()) {
                $products->updateExistingPivot(
                    request()->product_id, 
                    ['qty' => ($products->first()->pivot->qty + 1)]
                );
            } else {
                $transaction->products()->add();
            }
            return $this;
        };
    }
}