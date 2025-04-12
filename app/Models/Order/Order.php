<?php

namespace App\Models\Order;

use App\Observers\OrderObserver;
use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $guarded = [];
    public function orderable(): MorphTo
    {
        return $this->morphTo();
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(OrderObserver::class);
    }
}
