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
}