<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Governorate;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\EndPoint\Governorate\FetchGovernorateService;
use App\Http\Resources\Dashboard\EndPoint\Governorate\FetchGovernorateResource;

class FetchGovernorateController extends Controller
{
    use ApiResponse;
    public function __construct(private FetchGovernorateService $fetchGovernorateService) {}
    public function __invoke()
    {
        try {
            $governorates = $this->fetchGovernorateService->fetchGovernorates();
            $response = FetchGovernorateResource::collection($governorates);
            return $this->dataResponse('fetch all governorates', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
