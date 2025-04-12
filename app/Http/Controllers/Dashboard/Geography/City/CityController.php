<?php

namespace App\Http\Controllers\Dashboard\Geography\City;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Geography\City\CityService;
use App\Http\Requests\Dashboard\Geography\City\CityRequest;
use App\Http\Resources\Dashboard\Geography\City\CityResource;
use App\Http\Resources\Dashboard\Geography\City\ShowCityResource;

class CityController extends Controller
{
    use ApiResponse;
    public function __construct(private CityService $cityService) {}
    public function index()
    {
        try {
            $cities = $this->cityService->index();
            $response = CityResource::collection($cities)->response()->getData(true);
            return $this->dataResponse('fetch all cities', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->cityService->show($id);
            $response = new ShowCityResource($row);
            return $this->dataResponse('show city', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(CityRequest $request)
    {
        try {
            $city = $this->cityService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new CityResource($city), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(CityRequest $request, int $id)
    {
        try {
            $city = $this->cityService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new CityResource($city), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->cityService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
