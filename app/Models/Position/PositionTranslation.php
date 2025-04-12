<?php

namespace App\Models\Position;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionTranslation extends Model
{
    use HasFactory;
    protected $table = 'position_translations';
    protected $guarded = [];
}
