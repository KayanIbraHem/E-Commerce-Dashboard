<?php

namespace App\Models\ClientAddress;

use App\Models\Client\Client;
use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientAddress extends Model
{
    use HasFactory;
    protected $table = 'client_addresses';
    protected $guarded = [];
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
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
