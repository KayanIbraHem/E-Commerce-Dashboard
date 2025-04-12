<?php

namespace App\Http\Controllers\Dashboard\ClientAddress;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ClientAddress\ClientAddressRequest;
use App\Services\Dashboard\ClientAddress\ClientAddressService;
use App\Http\Resources\Dashboard\ClientAddress\ClientAddressResource;

class ClientAddressController extends Controller
{
    use ApiResponse;
    public function __construct(private ClientAddressService $clientAddressService) {}
    public function index()
    {
        try {
            $clientAddresses = $this->clientAddressService->index();
            $response = ClientAddressResource::collection($clientAddresses)->response()->getData(true);
            return $this->dataResponse('fetch all clientAddresses', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->clientAddressService->show($id);
            $response = new ClientAddressResource($row);
            return $this->dataResponse('show clientAddress', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(ClientAddressRequest $request)
    {
        try {
            $clientAddress = $this->clientAddressService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new ClientAddressResource($clientAddress), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(ClientAddressRequest $request, int $id)
    {
        try {
            $driver = $this->clientAddressService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new ClientAddressResource($driver), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->clientAddressService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
