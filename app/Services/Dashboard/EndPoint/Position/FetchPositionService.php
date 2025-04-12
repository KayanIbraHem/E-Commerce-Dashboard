<?php

namespace App\Services\Dashboard\EndPoint\Position;

use App\Bases\CrudOperation\CrudOperationBase;

class FetchPositionService
{
    public function __construct(protected CrudOperationBase $crudOperationBase)
    {
        $this->crudOperationBase->setModel('App\\Models\\Position\\Position');
        $this->crudOperationBase->setHasPaginate(false);
    }
    public function fetchPositions()
    {
        return $this->crudOperationBase->index();
    }
}
