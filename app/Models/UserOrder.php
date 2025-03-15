<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;

class UserOrder extends Model
{
    use HasFactory;

    protected $table = 'user_orders';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'order_id',
        'username',
        'telpNumber',
        'description',
        'totalPrice',
        'paymentStatus',
        'weight',
        'volume',
        'commodities',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Format total harga ke dalam Rupiah
     */
    public function getTotalPriceFormattedAttribute()
    {
        return "Rp " . number_format($this->totalPrice, 2, ',', '.');
    }
}
