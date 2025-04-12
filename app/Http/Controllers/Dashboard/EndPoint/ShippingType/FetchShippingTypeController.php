<?php

namespace App\Http\Controllers\Dashboard\EndPoint\ShippingType;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\EndPoint\ShippingType\FetchShippingTypeService;
use App\Http\Resources\Dashboard\EndPoint\ShippingType\FetchShippingTypeResource;

class FetchShippingTypeController extends Controller
{
    use ApiResponse;
    public function __construct(private FetchShippingTypeService $fetchShippingTypeService) {}
    public function __invoke()
    {
        try {
            $shippingTypes = $this->fetchShippingTypeService->fetchShippingTypes();
            $response = FetchShippingTypeResource::collection($shippingTypes);
            return $this->dataResponse('fetch all shippingTypes', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
