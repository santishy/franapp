<?php

namespace App\Models;

use App\Models\Traits\HasStock;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Inventory extends Model
{
    use HasFactory, HasStock;

    protected $fillable = ['name', 'address'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('stock');
    }
    public function scopeStock($query)
    {
        $query->withPivot('stock');
    }
    public function scopeHasStock($query)
    {
        return $query->withPivot('stock', '>', 0);
    }
}
