<?php

namespace App\Http\Controllers\Dashboard\Permission;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Permisssion\PermissionService;
use App\Http\Resources\Dashboard\Permission\PermissionResource;
use App\Http\Requests\Dashboard\Permission\StorePermissionRequest;
use App\Http\Resources\Dashboard\Permission\ShowPermissionResource;

class PermissionController extends Controller
{
    use ApiResponse;
    public function __construct(private PermissionService $permissionService) {}
    public function index()
    {
        try {
            $permissions = $this->permissionService->index();
            $response = PermissionResource::collection($permissions)->response()->getData(true);
            return $this->dataResponse('fetch all permissions', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->permissionService->show($id);
            $response = new ShowPermissionResource($row);
            return $this->dataResponse('show permission', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StorePermissionRequest $request)
    {
        try {
            $permission = $this->permissionService->store(dataRequest: $request);
            return $this->dataResponse(__('message.success_create'),  new PermissionResource($permission), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(StorePermissionRequest $request, int $id)
    {
        try {
            $permission = $this->permissionService->update(dataRequest: $request, id: $id);
            return $this->dataResponse(__('message.success_update'),  new PermissionResource($permission), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->permissionService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
