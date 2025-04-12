<?php

namespace App\Services\Dashboard\ShippingType;

use App\Bases\CrudOperation\CrudOperationBase;

class ShippingTypeService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\ShippingType\\ShippingType';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
