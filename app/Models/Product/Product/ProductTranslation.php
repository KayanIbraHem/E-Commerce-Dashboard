<?php

namespace App\Models\Product\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{
    use HasFactory;
    protected $table = 'product_translations';
    protected $guarded = [];
}
