<?php

namespace App\Models\Product\Product;

use App\Models\Image\Image;
use App\Models\Category\Category;
use App\Models\OrganizationEmployee\OrganizationEmployee;
use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Product\ProductFeature\ProductFeature;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Translatable;
    protected $table = 'products';
    protected $guarded = [];
    public $translatedAttributes = ['title', 'description'];
    protected $translationForeignKey = 'product_id';
    public function mainImageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->main_image ? url($this->main_image) : ''
        );
    }
    public function videoLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->video ? url($this->video) : ''
        );
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(OrganizationEmployee::class, 'organization_employee_id', 'id');
    }
    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function features(): HasMany
    {
        return $this->hasMany(ProductFeature::class, 'product_id', 'id');
    }
    public function scopeSearch(Builder $builder): Builder
    {
        return $builder->when(request()->get('word'), fn($query, $word) => $query->whereTranslationLike('title', "%{$word}%"))
            ->when(request()->get('id'), fn($query, $id) => $query->where('id', $id));
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

        static::deleting(function ($model) {

            foreach ($model->images as $image) {
                if ($image->image) {
                    deleteImage($image->image);
                }
                $image->delete();
            }
        });
    }
}
