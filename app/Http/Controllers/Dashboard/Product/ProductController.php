<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Product\ProductService;
use App\Http\Resources\Dashboard\Product\Product\ProductResource;
use App\Http\Requests\Dashboard\Product\Product\StoreProductRequest;
use App\Http\Requests\Dashboard\Product\Product\UpdateProductRequest;
use App\Http\Resources\Dashboard\Product\Product\ShowProductResource;

class ProductController extends Controller
{
    use ApiResponse;
    public function __construct(private ProductService $productService) {}
    public function index()
    {
        try {
            $products = $this->productService->index();
            $response = ProductResource::collection($products)->response()->getData(true);
            return $this->dataResponse('fetch all products', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->productService->show($id);
            $response = new ShowProductResource($row);
            return $this->dataResponse('show product', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StoreProductRequest $request)
    {
        try {
            $product = $this->productService->store(dataRequest: $request);
            return $this->dataResponse(__('message.success_create'),  new ProductResource($product), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(UpdateProductRequest $request, int $id)
    {
        try {
            $product = $this->productService->update(dataRequest: $request, id: $id);
            return $this->dataResponse(__('message.success_update'),  new ProductResource($product), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->productService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
