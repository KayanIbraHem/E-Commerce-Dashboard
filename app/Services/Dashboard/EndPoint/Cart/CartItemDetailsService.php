<?php

namespace App\Services\Dashboard\EndPoint\Cart;

use App\Bases\CrudOperation\CrudOperationBase;


class CartItemDetailsService
{
    public function __construct(protected CrudOperationBase $crudOperationBase)
    {
        $this->crudOperationBase->setModel('App\\Models\\Product\\Product\\Product');
        $this->crudOperationBase->setHasPaginate(false);
    }
    public function cartItemDetails($id)
    {
        return $this->crudOperationBase->show($id);
    }
}

