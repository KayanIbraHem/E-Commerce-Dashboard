<?php

namespace App\Http\Controllers\Dashboard\EndPoint\City;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\EndPoint\City\FetchCityService;
use App\Http\Resources\Dashboard\EndPoint\City\FetchCityResource;
use App\Services\Dashboard\EndPoint\Governorate\FetchGovernorateService;
use App\Http\Resources\Dashboard\EndPoint\Governorate\FetchGovernorateResource;

class FetchCityController extends Controller
{
    use ApiResponse;
    public function __construct(private FetchCityService $fetchCityService) {}
    public function __invoke()
    {
        try {
            $cities = $this->fetchCityService->fetchCities();
            $response = FetchCityResource::collection($cities);
            return $this->dataResponse('fetch all cities', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
