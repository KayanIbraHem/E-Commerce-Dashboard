<?php

namespace App\Models\Category;

use App\Models\Section\Section;
use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Translatable;
    protected $table = 'categories';
    protected $guarded = [];
    public $translatedAttributes = ['title'];
    protected $translationForeignKey = 'category_id';
    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? url($this->image) : ''
        );
    }
    public function sections(): HasMany
    {
        return $this->hasMany(Section::class, 'category_id', 'id');
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
