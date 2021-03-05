<?php

namespace App\Http\Traits;

trait HasTransaction 
{
    protected function deleteSessionVariable($key){
        request()->session()->forget($key);
    }

    protected function getTransactionBySession($model,$key){
        return $model->find($key);
    }
    protected function deleteTransactionProduct($transaction,$id){
        $transaction->products()->detach($id);
    }
 
}