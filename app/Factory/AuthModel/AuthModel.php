<?php
namespace App\Factory\AuthModel;


use App\Models\Client\Client;
use App\Models\OrganizationEmployee\OrganizationEmployee;

class AuthModel
{
    public function getModel($guard)
    {
        return match ($guard) {
            'employee' => new OrganizationEmployee(),
            'client' => new Client(),
            default => throw new \InvalidArgumentException("Invalid guard: $guard"),
        };
    }
}
