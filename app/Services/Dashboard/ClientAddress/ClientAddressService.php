<?php

namespace App\Services\Dashboard\ClientAddress;

use App\Bases\CrudOperation\CrudOperationBase;

class ClientAddressService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\ClientAddress\\ClientAddress';
}
