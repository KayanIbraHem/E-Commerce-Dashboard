<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Client;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Queries\Client\SearchClient;
use App\Http\Requests\Dashboard\EndPoint\Client\SearchClientRequest;
use App\Http\Resources\Dashboard\EndPoint\Client\SearchClientResource;

class SearchClientController extends Controller
{
    use ApiResponse;
    public function __construct(private SearchClient $searchClient) {}
    public function __invoke(SearchClientRequest $request)
    {
        try {
            $clients = $this->searchClient->search($request);
            $response =  SearchClientResource::collection($clients);
            return $this->dataResponse('search client', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
