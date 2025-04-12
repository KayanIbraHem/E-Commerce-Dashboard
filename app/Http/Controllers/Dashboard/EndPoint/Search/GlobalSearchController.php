<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Search;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Queries\GlobalSearch\GlobalSearch;
use App\Http\Requests\Dashboard\EndPoint\GlobalSearch\GlobalSearchRequest;
use App\Http\Resources\Dashboard\EndPoint\GlobalSearch\GlobalSearchResource;

class GlobalSearchController extends Controller
{
    use ApiResponse;
    public function __construct(private GlobalSearch $globalSearch) {}
    public function __invoke(GlobalSearchRequest $request)
    {
        try {
            $global = $this->globalSearch->search($request);
            $response =  new GlobalSearchResource($global);
            return $this->dataResponse('GlobalSearch', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
