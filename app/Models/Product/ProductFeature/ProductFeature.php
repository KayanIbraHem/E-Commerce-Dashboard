<?php

namespace App\Models\Product\ProductFeature;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Product\ProductAdvantage\ProductAdvantage;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductFeature extends Model
{
    use HasFactory, Translatable,SoftDeletes;
    protected $table = 'product_features';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'product_feature_id';
    public function advantages(): HasMany
    {
        return $this->hasMany(ProductAdvantage::class, 'product_feature_id', 'id');
    }
}
