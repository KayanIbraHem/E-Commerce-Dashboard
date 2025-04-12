<?php

namespace App\Models\PermissionDetail;

use App\Observers\GlobalObserver;
use App\Models\Permission\Permission;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PermissionDetail extends Model
{
    use HasFactory, Translatable;
    protected $table = 'permission_details';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'permission_detail_id';


    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(GlobalObserver::class);
    }
}
