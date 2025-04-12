<?php

namespace App\Http\Controllers\Dashboard\Employee\Employee;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Employee\Employee\EmployeeService;
use App\Http\Resources\Dashboard\Employee\Employee\EmployeeResource;
use App\Http\Requests\Dashboard\Employee\Employee\StoreEmployeeRequest;
use App\Http\Requests\Dashboard\Employee\Employee\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    use ApiResponse;
    public function __construct(private EmployeeService $employeeService) {}
    public function index()
    {
        try {
            $employees = $this->employeeService->index();
            $response = EmployeeResource::collection($employees)->response()->getData(true);
            return $this->dataResponse('fetch all employees', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->employeeService->show($id);
            $response = new EmployeeResource($row);
            return $this->dataResponse('show position', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee = $this->employeeService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new EmployeeResource($employee), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(UpdateEmployeeRequest $request, int $id)
    {
        try {
            $employee = $this->employeeService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new EmployeeResource($employee), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->employeeService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
