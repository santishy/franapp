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
            // $products = $this->products()
            //     ->where(['product_id' => $product_id]);
            // if ($products->exists()) {
            //     $products->updateExistingPivot(
            //         request()->product_id, 
            //         ['qty' => ($products->first()->pivot->qty + 1)]
            //     );
            // } else {
            //     $this->products()->add();
            // }
            return $this;
        };
    }

    public function getTransaction(){
        return function(){
            $this->findOrCreateTheTransaction();
            return ;
        };
    }
}