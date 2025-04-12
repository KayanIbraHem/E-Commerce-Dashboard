<?php

namespace App\Http\Controllers\Dashboard\Employee\Auth;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Employee\Auth\EmployeeChangePasswordService;
use App\Http\Requests\Dashboard\Employee\Auth\EmployeeChangePasswordRequest;

class EmployeeChangePasswordController extends Controller
{
    use ApiResponse;

    public function __construct(protected EmployeeChangePasswordService $employeeChangePasswordService) {}

    public function __invoke(EmployeeChangePasswordRequest $request)
    {
        try {
            $this->employeeChangePasswordService->changePassword(request: $request);
            $msg = __('auth.success_change_password');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
