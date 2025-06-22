<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class UserOrderItem extends Model
{
   use HasFactory;

    protected $table = 'user_order_items';
    public $timestamps = true;
    protected $fillable = [
        'userOrder_id',
        'volume',
        'weight',
        'length',
        'height',
        'width',
        'qty',
        'price',
        'commodities',
    ];

    public function userOrder()
    {
        return $this->belongsTo(UserOrder::class, 'userOrder_id');
    }
}
