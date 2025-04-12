<?php

namespace App\Services\Dashboard\Employee\Auth;

use Illuminate\Support\Facades\Hash;
use App\Bases\Trait\UserAuthentication;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrganizationEmployee\OrganizationEmployee;

class EmployeeLoginService
{
    use UserAuthentication;
    const MODEL = "App\\Models\\OrganizationEmployee\\OrganizationEmployee";

    public function login(object $request)
    {
        $user = $this->getRow($request['email'], self::MODEL);
        $this->validatePassword($request['password'], $user);
        $this->generateToken($user);
        return $user;
    }

}
