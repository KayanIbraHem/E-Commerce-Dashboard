<?php

namespace App\Http\Controllers\Dashboard\Employee\Auth;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Employee\Auth\EmployeeLoginService;
use App\Services\Dashboard\Employee\Auth\EmployeeLogoutService;
use App\Http\Requests\Dashboard\Employee\Auth\EmployeeLoginRequest;
use App\Http\Resources\Dashboard\Employee\Auth\EmployeeLoginResource;

class EmployeeLogoutController extends Controller
{
    use ApiResponse;
    public function __construct(protected EmployeeLogoutService $employeeLogoutService) {}
    public function __invoke()
    {
        try {
            $this->employeeLogoutService->logout();
            $msg = __(key: 'auth.success_logout');
            return $this->successResponse(msg: $msg, code: 200);
        } catch (\Exception $e) {
            return $this->returnException(message: $e->getMessage(), code: 500);
        }
    }
}
