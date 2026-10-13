<?php

namespace App\Http\Requests;

use App\Models\Sale;
use App\Rules\CanSaleReturn;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Override;

class StoreSaleReturnRequest extends FormRequest
{
    public function sale(): Sale
    {
        return $this->route("sale");
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "resolution" => [
                "in:exchange,refund",
                "required",
                new CanSaleReturn($this->sale()),
            ],
            "products" => ["array", "required"],
            "products.*.product_id" => [
                "required",
                "distinct",
                "integer",
                Rule::exists("product_sale", "product_id")->where(
                    "sale_id",
                    $this->sale()->id,
                ),
            ],
            "products.*.qty" => ["required", "integer", "min:1"],
            "payment_method" => ["required", "in:cash,bank_transfer,card"],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->hasAny("products.*", "products")) {
                    return;
                }
                foreach ($this->products as $index => $item) {
                    if (
                        $this->sale()->returnableQty($item["product_id"]) <
                        $item["qty"]
                    ) {
                        $validator
                            ->errors()
                            ->add(
                                "products.{$index}.qty",
                                "La cantidad de devolución es mayor que la de la venta original",
                            );
                    }
                }
            },
        ];
    }
    #[Override]
    public function messages()
    {
        return [
            "resolution.required" => "La resolución es obligatoria",
            "resolution.in" => "La resolución debe ser canje o devolución",
            "products.required" => "Los productos son obligatorios",
            "products.array" => "El listado de productos debe ser un arreglo",
            "products.*.product_id.required" => "El producto es obligatorio",
            "products.*.product_id.integer" => "El producto debe ser un número",
            "products.*.product_id.exists" =>
                "El producto no existe en esta venta",
            "products.*.qty.required" => "La cantidad es obligatoria",
            "products.*.qty.integer" => "La cantidad debe ser un número",
            "products.*.qty.min" => "La cantidad mínima es 1",
            "payment_method.required" => "El método de pago es obligatorio",
            "payment_method.in" => "El método de pago es inválido",
            "distinct" =>
                "Los productos se pueden enviar solo una vez por devolución",
        ];
    }
}
