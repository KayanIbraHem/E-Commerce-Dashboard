<?php

namespace App\Services\Dashboard\EndPoint\ShippingType;

use App\Bases\CrudOperation\CrudOperationBase;

class FetchShippingTypeService
{
    public function __construct(protected CrudOperationBase $crudOperationBase)
    {
        $this->crudOperationBase->setModel('App\\Models\\ShippingType\\ShippingType');
        $this->crudOperationBase->setHasPaginate(false);
    }
    public function fetchShippingTypes()
    {
        return $this->crudOperationBase->index();
    }
}
