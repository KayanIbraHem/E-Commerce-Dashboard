<?php

namespace App\Queries\Client;

use App\Models\Client\Client;

class SearchClient
{
    public function search($request)
    {
        return Client::perOrganization()->get();
    }
}
