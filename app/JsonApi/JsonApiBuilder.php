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
        return function($product)  {
            $transaction = $this->model->products();
            if($transaction->where('product_id',$product->id)->exists){
                $transaction->updateExistingPivot($product->id, ['qty' => ($transaction->first()->pivot->qty + 1)]);
                return $this;
            }
            $transaction->attach($product->id, [
                'purchase_price' => $product->sale_price,
                'qty' => 1
            ]);

        };
    }

   

    public function getTransaction(){
        return function(){
            $transaction = $this->findOrCreateTheTransaction();
            return $transaction;
        };
    }
}