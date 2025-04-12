<?php

namespace App\Services\Dashboard\EndPoint\ComplaintType;

use App\Bases\CrudOperation\CrudOperationBase;

class FetchComplaintTypeService
{
    public function __construct(protected CrudOperationBase $crudOperationBase)
    {
        $this->crudOperationBase->setModel('App\\Models\\ComplaintType\\ComplaintType');
        $this->crudOperationBase->setHasPaginate(false);
    }
    public function fetchPositions()
    {
        return $this->crudOperationBase->index();
    }
}
