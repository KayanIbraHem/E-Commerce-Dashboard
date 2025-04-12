<?php

namespace App\Services\Dashboard\EndPoint\Permission;

use App\Bases\CrudOperation\CrudOperationBase;

class FetchPermissionService
{
    public function __construct(protected CrudOperationBase $crudOperationBase)
    {
        $this->crudOperationBase->setModel('App\\Models\\Permission\\Permission');
        $this->crudOperationBase->setHasPaginate(false);
    }
    public function fetchPermissions()
    {
        return $this->crudOperationBase->index();
    }
}
