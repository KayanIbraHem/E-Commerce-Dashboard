<?php

namespace App\Services\Dashboard\ComplaintType;

use App\Bases\CrudOperation\CrudOperationBase;

class ComplaintService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Complaint\\Complaint';
    protected bool $hasTranslatedColumns = false;
}
