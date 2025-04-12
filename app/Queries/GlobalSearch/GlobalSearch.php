<?php

namespace App\Queries\GlobalSearch;

use App\Models\Client\Client;
use App\Models\Driver\Driver;
use App\Models\OrganizationEmployee\OrganizationEmployee;

class GlobalSearch
{
    public function search($dataRequest)
    {
        $employees = OrganizationEmployee::perOrganization()->get();
        $drivers = Driver::perOrganization()->get();
        $clients = Client::perOrganization()->get();
        return [
            'employees' => $employees,
            'drivers' => $drivers,
            'clients' => $clients
        ];
    }
}
