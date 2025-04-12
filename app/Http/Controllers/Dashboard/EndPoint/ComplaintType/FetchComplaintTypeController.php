<?php

namespace App\Http\Controllers\Dashboard\EndPoint\ComplaintType;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\EndPoint\ComplaintType\FetchComplaintTypeService;
use App\Http\Resources\Dashboard\EndPoint\ComplaintType\FetchComplaintTypeResource;

class FetchComplaintTypeController extends Controller
{
    use ApiResponse;
    public function __construct(private FetchComplaintTypeService $fetchComplaintTypeService) {}
    public function __invoke(Request $request)
    {
        try {
            $complaintTypes = $this->fetchComplaintTypeService->fetchPositions();
            $response = FetchComplaintTypeResource::collection($complaintTypes);
            return $this->dataResponse('fetch all positions', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
