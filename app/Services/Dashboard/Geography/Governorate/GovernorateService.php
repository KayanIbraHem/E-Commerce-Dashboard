<?php

namespace App\Services\Dashboard\Geography\Governorate;

use App\Bases\CrudOperation\CrudOperationBase;

class GovernorateService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Geography\\Governorate\\Governorate';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
