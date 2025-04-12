<?php

namespace App\Http\Controllers\Dashboard\Employee\Profile;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Employee\Profile\EmployeeProfileService;
use App\Http\Requests\Dashboard\Employee\Profile\EmployeeProfileRequest;
use App\Http\Resources\Dashboard\Employee\Profile\EmployeeProfileResource;

class EmployeeProfileController extends Controller
{
    use ApiResponse;
    public function __construct(private EmployeeProfileService $employeeProfileService) {}

    public function showProfile()
    {
        try {
            $employeeId = auth('employee')->user()->id;
            $row = $this->employeeProfileService->show($employeeId);
            $response = new EmployeeProfileResource($row);
            return $this->dataResponse('show employee profile', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function updateProfile(EmployeeProfileRequest $request)
    {
        try {
            $employeeId = auth('employee')->user()->id;
            $employee = $this->employeeProfileService->update(dataRequest: $request->validated(), id: $employeeId);
            return $this->dataResponse(__('message.success_update'),  new EmployeeProfileResource($employee), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
