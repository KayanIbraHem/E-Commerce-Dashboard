<?php

namespace App\Models\Image;

use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $guarded = [];
    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? url($this->image) : ''
        );
    }
    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(GlobalObserver::class);
    }
}
