<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['sku', 'distributor_price','image', 'wholesale_price', 'retail_price', 'description', 'category_id'];

    public function scopeSearch(Builder $query, $values)
    {
        $index = 0;
        foreach (Str::of($values)->explode(' ') as $value) {
            if ($index == 0) $clause = 'where';
            else $clause = 'orWhere';

            $query->{$clause}('sku', 'LIKE', "%{$value}%")
                ->orWhere('description', 'LIKE', "%{$value}%");
            $index++;
        }
    }

    public function scopeByCategory(Builder $query, $id)
    {
        $query->where('category_id', $id);
    }
    public function sales()
    {
        return $this->belongsToMany(Sale::class);
    }

    public function purchases()
    {
        return $this->belongsToMany(Purchase::class);
    }

    public function inventories()
    {
        return $this->belongsToMany(Inventory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function uploadImage()
    {
        $path = null;
        
        if (request()->exists('image')) {
            if (!is_null($this->image)) {
                if (file_exists($this->image)) {
                    Storage::delete($this->image);
                }
            }
            $path = request()->file('image')->store('public/images');
        }
        return $path;
    }
}
