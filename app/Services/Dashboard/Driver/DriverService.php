<?php

namespace App\Services\Dashboard\Driver;

use App\Bases\CrudOperation\CrudOperationBase;

class DriverService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Driver\\Driver';
    protected array $imageKeys = [
        "image",
        "front_side_image",
        "back_side_image",
        "license_image",
        "driver_license_image"
    ];
}
