<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Permission;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\EndPoint\Permission\FetchPermissionService;
use App\Http\Resources\Dashboard\EndPoint\Permission\FetchPermissionResource;

class FetchPermissionController extends Controller
{
    use ApiResponse;
    public function __construct(private FetchPermissionService $fetchPermissionService) {}
    public function __invoke()
    {
        try {
            $permissions = $this->fetchPermissionService->fetchPermissions();
            $response = FetchPermissionResource::collection($permissions);
            return $this->dataResponse('fetch all permissions', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
