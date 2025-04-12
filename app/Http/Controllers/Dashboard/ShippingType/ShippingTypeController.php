<?php

namespace App\Http\Controllers\Dashboard\ShippingType;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\ShippingType\ShippingTypeService;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Requests\Dashboard\ShippingType\ShippingTypeRequest;
use App\Http\Resources\Dashboard\ShippingType\ShippingTypeResource;
use App\Http\Resources\Dashboard\ShippingType\ShowShippingTypeResource;

class ShippingTypeController extends Controller
{
    use ApiResponse;
    public function __construct(private ShippingTypeService $shippingTypeService) {}
    public function index()
    {
        try {
            $shippingTypes = $this->shippingTypeService->index();
            $response = ShippingTypeResource::collection($shippingTypes)->response()->getData(true);
            return $this->dataResponse('fetch all positions', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->shippingTypeService->show($id);
            $response = new ShowShippingTypeResource($row);
            return $this->dataResponse('show position', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(ShippingTypeRequest $request)
    {
        try {
            $shippingType = $this->shippingTypeService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new ShippingTypeResource($shippingType), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(ShippingTypeRequest $request, int $id)
    {
        try {
            $shippingType = $this->shippingTypeService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new ShippingTypeResource($shippingType), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->shippingTypeService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
