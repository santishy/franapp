<?php

namespace App\Rules;

use App\Models\Sale;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class CanSaleReturn implements ValidationRule
{
    public function __construct(private Sale $sale) {}

    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(
        string $attribute,
        mixed $value,
        Closure $fail,
    ): void {
        if ($this->sale->status !== "completed") {
            $fail(
                "La venta debe tener status completado para poder hacer una devolución",
            );
        }
    }
}
