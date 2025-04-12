<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class GlobalObserver
{
    public function creating(Model $model)
    {
        if (auth('employee')->check()) {
            $model->organization_id =  authEmployee()->organization_id;
            $model->organization_employee_id =  authEmployee()->id;
        }
    }
}
