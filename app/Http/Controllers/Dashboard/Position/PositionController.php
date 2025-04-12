<?php

namespace App\Http\Controllers\Dashboard\Position;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Position\PositionService;
use App\Http\Requests\Dashboard\Position\PositionRequest;
use App\Http\Resources\Dashboard\Position\PositionResource;
use App\Http\Resources\Dashboard\Position\ShowPositionResource;

class PositionController extends Controller
{
    use ApiResponse;
    public function __construct(private PositionService $positionService) {}
    public function index()
    {
        try {
            $positions = $this->positionService->index();
            $response = PositionResource::collection($positions)->response()->getData(true);
            return $this->dataResponse('fetch all positions', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->positionService->show($id);
            $response = new ShowPositionResource($row);
            return $this->dataResponse('show position', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(PositionRequest $request)
    {
        try {
            $position = $this->positionService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new PositionResource($position), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(PositionRequest $request, int $id)
    {
        try {
            $position = $this->positionService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new PositionResource($position), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->positionService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
