<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['name','address'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('stock');
    }
}
