<?php

namespace App\Models\Geography\City;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    use HasFactory;
    protected $table = 'city_translations';
    protected $guarded = [];
}
