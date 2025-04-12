<?php

namespace App\Models\Permission;

use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\PermissionDetail\PermissionDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends Model
{
    use HasFactory, Translatable;
    protected $table = 'permissions';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'permission_id';
    public function details()
    {
        return $this->hasMany(PermissionDetail::class, 'permission_id');
    }
    public function scopeSearch(Builder $builder): Builder
    {
        return $builder;
    }
    public function scopePerOrganization(Builder $builder): Builder
    {
        return $builder->when(auth('employee')->check(), function ($query) {
            return $query->where('organization_id', authEmployee()->organization_id)->orderBy('id', 'DESC')->search();
        });
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(GlobalObserver::class);
    }
}
