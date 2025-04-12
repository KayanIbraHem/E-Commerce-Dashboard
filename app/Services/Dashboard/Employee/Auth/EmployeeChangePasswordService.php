<?php

namespace App\Services\Dashboard\Employee\Auth;

use Illuminate\Support\Facades\Hash;
use App\Bases\Trait\UserAuthentication;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrganizationEmployee\OrganizationEmployee;

class EmployeeChangePasswordService
{
    use UserAuthentication;
    const GUARD = "employee";

    public function changePassword(object $request)
    {
        $user = $this->getAuthenticatedUser(guard: self::GUARD);
        $this->newPassword($request, $user);

        return $user;
    }
    protected function newPassword(object $request, Model $user)
    {
        $this->validatePassword($request->old_password, $user);
        $this->updatePassword($request->new_password, $user);

        return $user;
    }
    protected function updatePassword($password, Model $user): Model
    {
        $user->update([
            'password' => hashUserPassword($password),
        ]);

        return $user;
    }
}
