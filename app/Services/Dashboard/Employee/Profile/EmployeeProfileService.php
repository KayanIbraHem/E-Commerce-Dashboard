<?php

namespace App\Services\Dashboard\Employee\Profile;

use App\Bases\CrudOperation\CrudOperationBase;

class EmployeeProfileService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\OrganizationEmployee\\OrganizationEmployee';
    protected array $imageKeys = ["image"];
}
