<?php

namespace App\Services\Dashboard\Employee\Auth;

use Illuminate\Support\Facades\Hash;
use App\Bases\Trait\UserAuthentication;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrganizationEmployee\OrganizationEmployee;

class EmployeeLogoutService
{
    use UserAuthentication;
    const GUARD = "employee";
    public function logout(): void
    {
        $user = $this->getAuthenticatedUser(guard: self::GUARD);
        $this->removeToken(user: $user);
    }
}
