<?php

namespace App\Models\Geography\Area;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaTranslation extends Model
{
    use HasFactory;
    protected $table = 'area_translations';
    protected $guarded = [];
}
