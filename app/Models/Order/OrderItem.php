<?php

namespace App\Models\Order;

use App\Observers\GlobalObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $guarded = [];
}
