<?php

namespace App\Models\PermissionDetail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionDetailTranslation extends Model
{
    use HasFactory;
    protected $table = 'permission_detail_translations';
    protected $guarded = [];

   public $timestamps = false;
}
