<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class OrderObserver
{
    const EMPLOYEE_MODEL = 'App\Models\OrganizationEmployee\OrganizationEmployee';
    const CLIENT_MODEL = 'App\Models\Client\Client';
    public function creating(Model $model)
    {
        if (auth('employee')->check()) {
            $model->orderable_type =  self::EMPLOYEE_MODEL;
            $model->orderable_id =  authEmployee()->id;
        } else {
            $model->orderable_type =  self::CLIENT_MODEL;
            $model->orderable_id =  authClient()->id;
        }
    }
}
