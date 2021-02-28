<?php

namespace App\Http\Traits;

trait HasTransaction 
{
    protected function deleteSessionVariable($key){
        request()->session()->forget($key);
    }
}