<?php

namespace App\JsonApi;

class JsonApiBuilder
{

    public function applyFilters()
    {
        return function () {
            foreach (request('filter', []) as $filter => $value) {
                $this->{$filter}($value);
            }
            return $this;
        };
    }

    public function transactions()
    {
        return function ($product) {
            $transaction = $this->model->products();
            if ($transaction->where('product_id', $product->id)->exists()) {
                $this->updateTransactionProduct($transaction,$product); // la respuesta de sale es diferente al recargar la pagina en sale.create es diferente a la de cuando vas vendiendo un producto con vue
                // $transaction->updateExistingPivot(
                //     $product->id,
                //     [
                //         'qty' => ($transaction->first()->pivot->qty + 1),
                //         'sale_price' => $product->retail_price
                //     ]
                // );
                return $this;
            }
            $transaction->attach($product->id, [
                'sale_price' => $product->retail_price,
                'qty' => 1
            ]);
            return $this;
        };
    }



    public function getTransaction()
    {
        return function () {
            $transaction = $this->findOrCreateTheTransaction();
            return $transaction;
        };
    }
}
