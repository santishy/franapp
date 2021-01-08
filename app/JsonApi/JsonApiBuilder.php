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
            $this->model->products();
            return $this;
        };
    }

    public function getTransaction(){
        return function(){
            $transaction = $this->findOrCreateTheTransaction();
            return $transaction;
        };
    }
}