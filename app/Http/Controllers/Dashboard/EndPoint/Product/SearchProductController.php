<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Product;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Queries\Product\SearchProduct;
use App\Http\Requests\Dashboard\EndPoint\Product\SearchProductRequest;
use App\Http\Resources\Dashboard\EndPoint\Product\SearchProductResource;

class SearchProductController extends Controller
{

    use ApiResponse;
    public function __construct(private SearchProduct $searchProduct) {}
    public function __invoke(SearchProductRequest $request)
    {
        try {
            $products = $this->searchProduct->search($request);
            $response =  SearchProductResource::collection($products);
            return $this->dataResponse('search client', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
