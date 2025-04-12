<?php

namespace App\Services\Dashboard\EndPoint\City;

use App\Bases\CrudOperation\CrudOperationBase;

class FetchCityService
{
    public function __construct(protected CrudOperationBase $crudOperationBase)
    {
        $this->crudOperationBase->setModel('App\\Models\\Geography\\City\\City');
        $this->crudOperationBase->setHasPaginate(false);
    }
    public function fetchCities()
    {
        return $this->crudOperationBase->index();
    }
}
