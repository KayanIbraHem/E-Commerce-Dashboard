<?php

namespace App\Models\Product\ProductAdvantage;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductAdvantage extends Model
{
    use HasFactory, Translatable,SoftDeletes;
    protected $table = 'product_advantages';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'product_advantage_id';
}
