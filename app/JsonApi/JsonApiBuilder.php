<?php 

class JsonApiBuilder{

    public function search(){
        return function(){
            return $this->model->search();
        };
    }
}