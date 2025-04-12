<?php

namespace App\Models\Position;

use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory, Translatable;
    protected $table = 'positions';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'position_id';
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
