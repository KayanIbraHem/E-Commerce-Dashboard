<?php

namespace App\Http\Controllers\Dashboard\Employee\Profile;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Employee\Profile\EmployeeProfileImageService;

class EmployeeProfileImageController extends Controller
{
    use ApiResponse;
    public function __construct(private EmployeeProfileImageService $employeeProfileImageService) {}

    public function __invoke(Request $request)
    {
        try {
            $employee = auth('employee')->user();
            $this->employeeProfileImageService->delete($employee);
            return $this->successResponse('image deleted',  200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
