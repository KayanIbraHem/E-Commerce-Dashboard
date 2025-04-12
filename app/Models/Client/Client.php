<?php

namespace App\Models\Client;

use App\Models\Cart\Cart;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ClientAddress\ClientAddress;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = 'clients';
    protected $guarded = [];
    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? url($this->image) : ''
        );
    }
    public function addresses(): HasMany
    {
        return $this->hasMany(ClientAddress::class, 'client_id', 'id');
    }
    public function carts(): MorphMany
    {
        return $this->morphMany(Cart::class, 'cartable');
    }
    public function scopeSearch(Builder $builder): Builder
    {
        return $builder->when(request()->get('word'), fn($query, $word) => $query->where('name', 'LIKE', "%{$word}%"))
            ->when(request()->get('id'), fn($query, $id) => $query->where('id', $id));
    }
    public function scopePerOrganization(Builder $builder): Builder
    {
        return $builder->when(auth('employee')->check(), function ($query) {
            return $query->where('organization_id', authEmployee()->organization_id)->orderBy('id', 'DESC')->search();
        });
    }
    protected function hashPassword()
    {
        //this condition for register and crudbase
        //in register if not using sanctum it will hash password
        //in crudoperation it will hash password

        if (Hash::needsRehash($this->attributes['password'])) {
            $this->attributes['password'] = hashUserPassword($this->attributes['password']);
        }
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->hashPassword();
        });
        static::updating(function ($model) {
            if ($model->isDirty('password')) {
                $model->hashPassword();
            }
        });
    }
}
