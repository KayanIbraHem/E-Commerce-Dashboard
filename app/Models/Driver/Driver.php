<?php

namespace App\Models\Driver;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\Models\ShippingType\ShippingType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory, HasApiTokens;
    protected $table = "drivers";
    protected $guarded = [];
    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? url($this->image) : ''
        );
    }
    public function frontSideImageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->front_side_image ? url($this->front_side_image) : ''
        );
    }
    public function backSideImageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->back_side_image ? url($this->back_side_image) : ''
        );
    }
    public function licenseImageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->license_image ? url($this->license_image) : ''
        );
    }
    public function driverLicenseImageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->driver_license_image ? url($this->driver_license_image) : ''
        );
    }
    public function shippingType(): BelongsTo
    {
        return $this->belongsTo(ShippingType::class, 'shipping_type_id', 'id');
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
    public function scopeSearch(Builder $builder): Builder
    {
        return $builder->when(request()->get('word'), fn($query, $word) => $query->where('name', 'LIKE', "%{$word}%"));
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
        static::creating(function ($model) {
            if (auth('employee')->check()) { // this condition for seeder
                $model->organization_id = authEmployee()->organization_id;
                $model->organization_employee_id = authEmployee()->id;
                $model->hashPassword();
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('password')) {
                $model->hashPassword();
            }
        });
    }
}
