<?php

namespace App\Models\Geography\Governorate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GovernorateTranslation extends Model
{
    use HasFactory;
    protected $table = 'governorate_translations';
    protected $guarded = [];
}
