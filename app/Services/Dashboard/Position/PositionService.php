<?php

namespace App\Services\Dashboard\Position;

use App\Bases\CrudOperation\CrudOperationBase;

class PositionService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Position\\Position';
    protected bool $hasTranslatedColumns = true;
    protected array $translatedColumns = ['title'];
}
