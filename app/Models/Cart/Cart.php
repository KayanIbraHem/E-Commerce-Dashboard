<?php

namespace App\Models\Cart;

use App\Observers\CartObserver;
use App\Models\Product\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $guarded = [];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function cartable(): MorphTo
    {
        return $this->morphTo();
    }
    protected static function boot()
    {
        parent::boot();
        static::observe(CartObserver::class);
    }
}
