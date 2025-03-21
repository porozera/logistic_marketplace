<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        'services',
        'snap_token',
        'payment_token'
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

    public function getEstimatedDaysAttribute()
    {
        $shippingDate = Carbon::parse($this->shippingDate);
        $estimationDate = Carbon::parse($this->estimationDate);
        return $shippingDate->diffInDays($estimationDate);
    }

    public function getLoadingDateFormattedAttribute()
    {
        return Carbon::parse($this->loadingDate)->startOfDay()->translatedFormat('d F Y');
    }
    
    public function getShippingDateFormattedAttribute()
    {
        return Carbon::parse($this->shippingDate)->startOfDay()->translatedFormat('d F Y');
    }
    
    public function getEstimationDateFormattedAttribute()
    {
        return Carbon::parse($this->estimationDate)->startOfDay()->translatedFormat('d F Y');
    }    
}
