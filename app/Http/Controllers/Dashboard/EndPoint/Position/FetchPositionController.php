<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Position;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\EndPoint\Position\FetchPositionService;
use App\Http\Resources\Dashboard\EndPoint\Position\FetchPositionResource;

class FetchPositionController extends Controller
{
    use ApiResponse;
    public function __construct(private FetchPositionService $fetchPositionService) {}
    public function __invoke()
    {
        try {
            $positions=$this->fetchPositionService->fetchPositions();
            $response = FetchPositionResource::collection($positions);
            return $this->dataResponse('fetch all positions', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
