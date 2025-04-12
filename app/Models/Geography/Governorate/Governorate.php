<?php

namespace App\Models\Geography\Governorate;

use App\Observers\GlobalObserver;
use App\Models\Geography\Area\Area;
use App\Models\Geography\City\City;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Governorate extends Model
{
    use HasFactory, Translatable;
    protected $table = 'governorates';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'governorate_id';
    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'governorate_id', 'id');
    }
    public function areas(): HasMany
    {
        return $this->hasMany(Area::class, 'governorate_id', 'id');
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
