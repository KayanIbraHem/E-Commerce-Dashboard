<?php

namespace App\Services\Dashboard\Geography\City;

use App\Bases\CrudOperation\CrudOperationBase;

class CityService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Geography\\City\\City';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
