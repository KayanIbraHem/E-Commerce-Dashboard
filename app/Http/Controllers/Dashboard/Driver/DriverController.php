<?php

namespace App\Http\Controllers\Dashboard\Driver;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Driver\DriverService;
use App\Http\Resources\Dashboard\Driver\DriverResource;
use App\Http\Requests\Dashboard\Driver\StoreDriverRequest;
use App\Http\Requests\Dashboard\Driver\UpdateDriverRequest;

class DriverController extends Controller
{
    use ApiResponse;
    public function __construct(private DriverService $driverService) {}
    public function index()
    {
        try {
            $drivers = $this->driverService->index();
            $response = DriverResource::collection($drivers)->response()->getData(true);
            return $this->dataResponse('fetch all employees', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->driverService->show($id);
            $response = new DriverResource($row);
            return $this->dataResponse('show position', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StoreDriverRequest $request)
    {
        try {
            $driver = $this->driverService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new DriverResource($driver), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(UpdateDriverRequest $request, int $id)
    {
        try {
            $driver = $this->driverService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new DriverResource($driver), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->driverService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
