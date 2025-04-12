<?php

namespace App\Models\ComplaintType;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComplaintTypeTranslation extends Model
{
    use HasFactory;
    protected $table = 'complaint_type_translations';
    protected $guarded = [];
}
