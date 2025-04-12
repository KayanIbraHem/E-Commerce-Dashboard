<?php

namespace App\Models\OrganizationEmployee;

use App\Models\Cart\Cart;
use App\Models\Position\Position;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Scopes\PerOrganizationScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrganizationEmployee extends Model
{
    use HasFactory;
    protected $table = 'organization_employees';
    protected $guarded = [];
    // protected $appends = ['imageLink'];
    public function imageLink(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image ? url($this->image) : ''
        );
    }
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    public function permission(): BelongsTo
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(OrganizationEmployee::class, 'organization_employee_id');
    }
    public function carts():MorphMany{
        return $this->morphMany(Cart::class, 'cartable');
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
