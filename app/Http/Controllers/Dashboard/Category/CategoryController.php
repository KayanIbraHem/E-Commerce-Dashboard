<?php

namespace App\Http\Controllers\Dashboard\Category;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Category\CategoryService;
use App\Http\Resources\Dashboard\Category\CategoryResource;
use App\Http\Requests\Dashboard\Category\StoreCategoryRequest;
use App\Http\Requests\Dashboard\Category\UpdateCategoryRequest;
use App\Http\Resources\Dashboard\Category\ShowCategoryResource;

class CategoryController extends Controller
{
    use ApiResponse;
    public function __construct(private CategoryService $categoryService) {}
    public function index()
    {
        try {
            $categories = $this->categoryService->index();
            $response = CategoryResource::collection($categories)->response()->getData(true);
            return $this->dataResponse('fetch all categories', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->categoryService->show($id);
            $response = new ShowCategoryResource($row);
            return $this->dataResponse('show category', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StoreCategoryRequest $request)
    {
        try {
            $category = $this->categoryService->store(dataRequest: $request);
            return $this->dataResponse(__('message.success_create'),  new CategoryResource($category), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(UpdateCategoryRequest $request, int $id)
    {
        try {
            $category = $this->categoryService->update(dataRequest: $request, id: $id);
            return $this->dataResponse(__('message.success_update'),  new CategoryResource($category), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->categoryService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
