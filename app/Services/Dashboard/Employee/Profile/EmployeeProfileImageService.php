<?php

namespace App\Services\Dashboard\Employee\Profile;

class EmployeeProfileImageService
{
    public function delete($employee)
    {
        $employee->update(['image' => null]);
    }
}
