<?php

namespace App\Services\Dashboard\Geography\Area;

use App\Bases\CrudOperation\CrudOperationBase;

class AreaService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Geography\\Area\\Area';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
