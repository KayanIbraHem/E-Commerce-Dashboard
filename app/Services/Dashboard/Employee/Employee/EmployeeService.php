<?php

namespace App\Services\Dashboard\Employee\Employee;

use App\Bases\CrudOperation\CrudOperationBase;

class EmployeeService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\OrganizationEmployee\\OrganizationEmployee';
    protected array $imageKeys =[ "image"];
}
