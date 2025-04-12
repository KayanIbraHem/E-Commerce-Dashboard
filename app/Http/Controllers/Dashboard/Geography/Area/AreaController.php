<?php

namespace App\Http\Controllers\Dashboard\Geography\Area;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Geography\Area\AreaService;
use App\Http\Requests\Dashboard\Geography\Area\AreaRequest;
use App\Http\Resources\Dashboard\Geography\Area\AreaResource;
use App\Http\Resources\Dashboard\Geography\Area\ShowAreaResource;

class AreaController extends Controller
{
    use ApiResponse;
    public function __construct(private AreaService $areaService) {}
    public function index()
    {
        try {
            $areas = $this->areaService->index();
            $response = AreaResource::collection($areas)->response()->getData(true);
            return $this->dataResponse('fetch all areas', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->areaService->show($id);
            $response = new ShowAreaResource($row);
            return $this->dataResponse('show area', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(AreaRequest $request)
    {
        try {
            $area = $this->areaService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new AreaResource($area), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(AreaRequest $request, int $id)
    {
        try {
            $area = $this->areaService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new AreaResource($area), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->areaService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
