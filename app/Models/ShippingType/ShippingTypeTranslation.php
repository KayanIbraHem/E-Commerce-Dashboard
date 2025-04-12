<?php

namespace App\Models\ShippingType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingTypeTranslation extends Model
{
    use HasFactory;
    protected $table = 'shipping_type_translations';
    protected $guarded = [];
}
