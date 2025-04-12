<?php

namespace App\Models\Coupon;

use Carbon\Carbon;
use App\Models\Category\Category;
use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $guarded = [];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function isValid()
    {
        $expiredDateTime = Carbon::parse($this->start_date);
        $now = Carbon::now();
        if ($this->is_active == 0) {
            return false;
        }
        if ($this->used_count >= $this->usage_limit) {
            return false;
        }
        if ($this->start_date) {
            $startDateTime = Carbon::parse($this->start_date);
            if ($now->lt($startDateTime)) {
                return false;
            }
        }
        if ($this->end_date) {
            $expiredDateTime = Carbon::parse($this->end_date);
            if ($now->gt($expiredDateTime)) {
                return false;
            }
        }
        return true;
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
