<?php

namespace App\Models\Geography\Area;

use App\Observers\GlobalObserver;
use App\Models\Geography\City\City;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Geography\Governorate\Governorate;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory, Translatable;
    protected $table = 'areas';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'area_id';
    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
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
