<?php

namespace App\Bases\Facades;

use Illuminate\Support\Facades\Facade;

class ApiResponse extends Facade //dont forget to  make alias
{
    protected static function getFacadeAccessor()
    {
        return 'apiresponse';
    }
}
