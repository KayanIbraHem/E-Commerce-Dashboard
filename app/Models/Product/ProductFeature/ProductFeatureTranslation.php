<?php

namespace App\Models\Product\ProductFeature;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeatureTranslation extends Model
{
    use HasFactory;
    protected $table = 'product_feature_translations';
    protected $guarded = [];
}
