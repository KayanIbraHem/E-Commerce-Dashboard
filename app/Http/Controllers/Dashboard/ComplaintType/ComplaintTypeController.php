<?php

namespace App\Http\Controllers\Dashboard\ComplaintType;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\ComplaintType\ComplaintTypeService;
use App\Http\Requests\Dashboard\ComplaintType\ComplaintTypeRequest;
use App\Http\Resources\Dashboard\ComplaintType\ComplaintTypeResource;
use App\Http\Resources\Dashboard\ComplaintType\ShowComplaintTypeResource;

class ComplaintTypeController extends Controller
{
    use ApiResponse;
    public function __construct(private ComplaintTypeService $complaintTypeService) {}
    public function index()
    {
        try {
            $complaintTypes = $this->complaintTypeService->index();
            $response = ComplaintTypeResource::collection($complaintTypes)->response()->getData(true);
            return $this->dataResponse('fetch all complaintTypes', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->complaintTypeService->show($id);
            $response = new ShowComplaintTypeResource($row);
            return $this->dataResponse('show complaintType', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(ComplaintTypeRequest $request)
    {
        try {
            $complaintType = $this->complaintTypeService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new ComplaintTypeResource($complaintType), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(ComplaintTypeRequest $request, int $id)
    {
        try {
            $complaintType = $this->complaintTypeService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new ComplaintTypeResource($complaintType), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->complaintTypeService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
