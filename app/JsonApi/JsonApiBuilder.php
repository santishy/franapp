<?php

namespace App\JsonApi;

class JsonApiBuilder
{

    public function applyFilters()
    {
        return function () {
            foreach (request('filter', []) as $filter => $value) {
                abort_unless($this->hasNamedScope($filter),400,'El filtro no existe');
                $this->{$filter}($value);
            }
            return $this;
        };
    }

    public function transactions()
    {
        return function ($product) {
            $transaction = $this->model->products();
            if (!$transaction->where('product_id', $product->id)->exists()) {
                $transaction->attach($product->id, [
                    'sale_price' => $product->{request('salePriceOption')},
                    'qty' => 1
                ]);
            }
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
