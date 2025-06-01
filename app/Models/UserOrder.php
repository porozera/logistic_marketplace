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
        'receiverName',
        'receiverTelpNumber',
        'description',
        'destinationAddress',
        'originAddress',
        'invoiceNumber',
        'totalPrice',
        'paymentStatus',
        'RTL_start_date',
        'RTL_end_date',
        'snap_token',
        'payment_token',
        'expires_at'
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

    public function items()
    {
        return $this->hasMany(UserOrderItem::class);
    }

    /**
     * Format total harga ke dalam Rupiah
     */
    public function getTotalPriceFormattedAttribute()
    {
        return "Rp " . number_format($this->totalPrice, 2, ',', '.');
    }
    
    public function getInvoiceDate()
    {
        if (!$this->created_at) {
            return 'Tidak ada informasi tanggal';
        }
        return Carbon::parse($this->created_at)->translatedFormat('d F Y');
    }
}
