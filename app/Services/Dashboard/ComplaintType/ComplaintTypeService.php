<?php

namespace App\Services\Dashboard\ComplaintType;

use App\Bases\CrudOperation\CrudOperationBase;

class ComplaintTypeService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\ComplaintType\\ComplaintType';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
