<?php

namespace App\Models\Permission;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionTranslation extends Model
{
    use HasFactory;
    protected $table = 'permission_translations';
    protected $guarded = [];
}
