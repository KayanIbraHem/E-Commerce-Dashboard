<?php

namespace App\Http\Controllers\Dashboard\Geography\Governorate;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Geography\Governorate\GovernorateRequest;
use App\Http\Resources\Dashboard\Geography\Governorate\GovernorateResource;
use App\Services\Dashboard\Geography\Governorate\GovernorateService;
use App\Http\Resources\Dashboard\Geography\Governorate\ShowGovernorateResource;

class GovernorateController extends Controller
{
    use ApiResponse;
    public function __construct(private GovernorateService $governorateService) {}
    public function index()
    {
        try {
            $governorates = $this->governorateService->index();
            $response = GovernorateResource::collection($governorates)->response()->getData(true);
            return $this->dataResponse('fetch all governorates', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->governorateService->show($id);
            $response = new ShowGovernorateResource($row);
            return $this->dataResponse('show governorate', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(GovernorateRequest $request)
    {
        try {
            $governorate = $this->governorateService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new GovernorateResource($governorate), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(GovernorateRequest $request, int $id)
    {
        try {
            $governorate = $this->governorateService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new GovernorateResource($governorate), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->governorateService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
