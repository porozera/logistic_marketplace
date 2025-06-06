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
        'origin',
        'destination',
        'portOrigin',
        'portDestination',
        'transportationMode',
        'shipmentMode',
        'shipmentType',
        'pickupDate',
        'departureDate',
        'cyClosingDate',
        'etd',
        'eta',
        'deliveryDate',
        'arrivalDate',
        'maxWeight',
        'maxVolume',
        'remainingWeight',
        'remainingVolume',
        'status',
        'price',
        'totalAmount',
        'remainingAmount',
        'paidAmount',
        'paymentStatus',
        'lsp_id',
        'container_id',
        'truck_first_id',
        'truck_second_id',
        'cargoType',
    ];

    /**
     * Format tanggal sebelum dikembalikan ke view
     */
    public function getEstimatedDaysAttribute()
    {
        $startDate = $this->pickupDate ?? $this->departureDate ?? $this->etd ?? null;

        $endDate = $this->arrivalDate ?? $this->eta ?? null;

        if ($startDate && $endDate) {
            $start = Carbon::parse($startDate);
            $end = Carbon::parse($endDate);

            return $start->diffInDays($end);
        }
        return null;
    }

    public function getETA()
    {
        if (!$this->eta) {
        return 'Tidak ada informasi tanggal';
        }
        return Carbon::parse($this->eta)->translatedFormat('d F Y');
    }

    public function getETD()
    {
        if (!$this->etd) {
        return 'Tidak ada informasi tanggal';
        }
        return Carbon::parse($this->etd)->translatedFormat('d F Y');
    }

    public function getpickupDate()
    {
        if (!$this->pickupDate) {
        return 'Tidak ada informasi tanggal';
        }
        return Carbon::parse($this->pickupDate)->translatedFormat('d F Y');
    }

    public function getdepartureDate()
    {
        if (!$this->departureDate) {
        return 'Tidak ada informasi tanggal';
        }
        return Carbon::parse($this->departureDate)->translatedFormat('d F Y');
    }

    public function getcyclosingDate()
    {
        if (!$this->cyClosingDate) {
        return 'Tidak ada informasi tanggal';
        }
        return Carbon::parse($this->cyClosingDate)->translatedFormat('d F Y');
    }

    public function getdeliveryDate()
    {
        if (!$this->deliveryDate) {
        return 'Tidak ada informasi tanggal';
        }
        return Carbon::parse($this->deliveryDate)->translatedFormat('d F Y');
    }

    public function getarrivalDate()
    {
        if (!$this->arrivalDate) {
        return 'Tidak ada informasi tanggal';
        }
        return Carbon::parse($this->arrivalDate)->translatedFormat('d F Y');
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

    public function container()
    {
        // return $this->belongsTo(Truck::class, 'truck_second_id');
        return $this->belongsTo(Container::class, 'container_id');
    }
}
