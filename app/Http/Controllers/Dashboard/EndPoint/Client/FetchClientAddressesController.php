<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Client;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\EndPoint\Client\FetchClientAddressesService;
use App\Http\Resources\Dashboard\EndPoint\ClientAddress\FetchClientAddressesResource;

class FetchClientAddressesController extends Controller
{
    use ApiResponse;
    public function __construct(private FetchClientAddressesService $fetchClientAddressesService) {}
    public function __invoke($id)
    {
        try {
            $clientAddresses = $this->fetchClientAddressesService->fetchclientAddresses($id);
            $response =  FetchClientAddressesResource::collection($clientAddresses);
            return $this->dataResponse('fetch client addresses', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
