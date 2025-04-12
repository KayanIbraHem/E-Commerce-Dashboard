<?php

namespace App\Models\ShippingType;

use App\Models\Driver\Driver;
use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingType extends Model
{
    use HasFactory, Translatable;
    protected $table = 'shipping_types';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'shipping_type_id';
    public function drivers(): HasMany
    {
        return $this->hasMany(Driver::class, 'shipping_type_id', 'id');
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
