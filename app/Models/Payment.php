<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ["user_id", "payment_method", "amount", "direction"];
    protected $casts = ["amount" => "decimal:2"];
    public function payable()
    {
        return $this->morphTo();
    }
}
