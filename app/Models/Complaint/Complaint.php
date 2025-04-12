<?php

namespace App\Models\Complaint;

use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Complaint extends Model
{
    use HasFactory;
    protected $table = 'complaints';
    protected $guarded = [];
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
