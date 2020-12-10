<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['sku','distributor_price','wholesale_price','retail_price','description'];

    public function scopeSearch(Builder $query,$values){
        foreach(Str::of($values)->explode(' ') as $value){
            $query->orWhere('sku','LIKE',"%{$value}%");
        }
    }
}
