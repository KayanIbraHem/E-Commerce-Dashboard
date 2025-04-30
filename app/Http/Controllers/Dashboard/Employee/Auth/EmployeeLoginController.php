<?php

namespace App\Http\Controllers\Dashboard\Employee\Auth;

use Illuminate\Http\Request;
// use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Employee\Auth\EmployeeLoginService;
use App\Http\Requests\Dashboard\Employee\Auth\EmployeeLoginRequest;
use App\Http\Resources\Dashboard\Employee\Auth\EmployeeLoginResource;
use App\Bases\Facades\ApiResponse;

class EmployeeLoginController extends Controller
{
    // use ApiResponse;
    public function __construct(protected EmployeeLoginService $employeeLoginService) {}
    public function __invoke(EmployeeLoginRequest $request)
    {
        try {
            $employee = $this->employeeLoginService->login($request);
            $response = new EmployeeLoginResource($employee);
            $msg = __('auth.success_login');
            // return $this->dataResponse($msg, $response, 200);
            return ApiResponse::dataResponse($msg, $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
