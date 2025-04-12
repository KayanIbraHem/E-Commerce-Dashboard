<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class CartObserver
{
    const EMPLOYEE_MODEL = 'App\Models\OrganizationEmployee\OrganizationEmployee';
    const CLIENT_MODEL = 'App\Models\Client\Client';
    public function creating(Model $model)
    {
        if (auth('employee')->check()) {
            $model->cartable_type =  self::EMPLOYEE_MODEL;
            $model->cartable_id =  authEmployee()->id;
        } else {
            $model->cartable_type =  self::CLIENT_MODEL;
            $model->cartable_id =  authClient()->id;
        }
    }
}
