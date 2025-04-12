<?php

namespace App\Queries\Product;

use App\Models\Product\Product\Product;

class SearchProduct
{
    public function search($request)
    {
        return Product::perOrganization()->get();
    }
}
