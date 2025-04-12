<?php

namespace App\Services\Dashboard\EndPoint\Client;

use App\Models\Client\Client;
use App\Bases\CrudOperation\CrudOperationBase;

class FetchClientAddressesService
{
    public function fetchclientAddresses($id)
    {
        return Client::whereId($id)->with('addresses')?->first()?->addresses ?? [];
    }
}
