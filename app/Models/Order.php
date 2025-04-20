<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = [
        'noOffer',
        'lspName',
        'origin',
        'destination',
        'shipmentMode',
        'shipmentType',
        'loadingDate',
        'shippingDate',
        'estimationDate',
        'maxWeight',
        'maxVolume',
        'remainingWeight',
        'remainingVolume',
        'commodities',
        'status',
        'price',
        'totalAmount',
        'remainingAmount',
        'paidAmount',
        'paymentStatus',
        'lsp_id',
        'address',
        'container_id',
        'truck_first_id',
        'truck_second_id',
        'address',
    ];

    /**
     * Format tanggal sebelum dikembalikan ke view
     */
    public function getLoadingDateFormattedAttribute()
    {
        return Carbon::parse($this->loadingDate)->translatedFormat('d F Y H:i');
    }

    public function getShippingDateFormattedAttribute()
    {
        return Carbon::parse($this->shippingDate)->translatedFormat('d F Y H:i');
    }

    public function getEstimationDateFormattedAttribute()
    {
        return Carbon::parse($this->estimationDate)->translatedFormat('d F Y H:i');
    }

    /**
     * Hitung sisa jumlah pembayaran
     */
    public function getRemainingAmountFormattedAttribute()
    {
        return number_format($this->remainingAmount, 2, ',', '.');
    }

    /**
     * Hitung total harga dalam format rupiah
     */
    public function getTotalAmountFormattedAttribute()
    {
        return "Rp " . number_format($this->totalAmount, 2, ',', '.');
    }


    public function lsp()
    {
        return $this->belongsTo(User::class, 'lsp_id');
    }

    public function userOrders()
    {
        return $this->hasMany(UserOrder::class);
    }

    public function offer()
    {
        return $this->belongsTo(offersModel::class, 'noOffer', 'noOffer');
    }

    public function truck_first()
    {
        return $this->belongsTo(Truck::class);
    }

    public function truck_second()
    {
        return $this->belongsTo(Truck::class);
    }
}
