<?php

namespace App\Http\Controllers\Dashboard\Product;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Product\ProductService;
use App\Http\Resources\Dashboard\Product\Product\ProductDetailsResource;

class ProductDetailsController extends Controller
{
    use ApiResponse;
    public function __construct(private ProductService $productService) {}

    public function __invoke(Request $request, int $id)
    {
        try {
            $row = $this->productService->show($id);
            $response = new ProductDetailsResource($row);
            return $this->dataResponse('product details', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
