<?php

namespace App\Services\Dashboard\EndPoint\Governorate;

use App\Bases\CrudOperation\CrudOperationBase;

class FetchGovernorateService
{
    public function __construct(protected CrudOperationBase $crudOperationBase)
    {
        $this->crudOperationBase->setModel('App\\Models\\Geography\\Governorate\\Governorate');
        $this->crudOperationBase->setHasPaginate(false);
    }
    public function fetchGovernorates()
    {
        return $this->crudOperationBase->index();
    }
}
