<?php

namespace App\Models\Geography\City;

use App\Observers\GlobalObserver;
use App\Models\Geography\Area\Area;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\PerOrganizationScope;
use App\Models\Geography\Governorate\Governorate;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory, Translatable;
    protected $table = 'cities';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'city_id';
    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }
    public function areas(): HasMany
    {
        return $this->hasMany(Area::class, 'city_id', 'id');
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
