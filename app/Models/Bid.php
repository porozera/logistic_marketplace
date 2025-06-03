<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $table = 'bids';

    protected $fillable = [
        'noOffer',
        'origin',
        'destination',
        'portOrigin',
        'portDestination',
        'shipmentMode',
        'shipmentType',
        'transportationMode',
        'pickupDate',
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
        'size',
        'price',
        'user_id',
        'requestOffer_id',
        'truck_first_id',
        'truck_second_id',
        'cargoType',
        'container_id',
    ];

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function truck_first()
    {
        return $this->belongsTo(Truck::class);
    }

    public function truck_second()
    {
        return $this->belongsTo(Truck::class);
    }

    public function requestRoute()
    {
        return $this->belongsTo(RequestRoute::class, 'requestOffer_id');
    }

    public function getEstimatedDaysAttribute()
    {
        // Prioritas penentuan start date: pickupDate > etd
        $startDate = $this->pickupDate ?? $this->etd ?? null;

        // Prioritas penentuan end date: arrivalDate > deliveryDate
        $endDate = $this->arrivalDate ?? $this->eta ?? null;

        if ($startDate && $endDate) {
            $start = Carbon::parse($startDate);
            $end = Carbon::parse($endDate);

            return $start->diffInDays($end);
        }

        // Jika tidak cukup data untuk menghitung estimasi
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
    public function container()
    {
        // return $this->belongsTo(Truck::class, 'truck_second_id');
        return $this->belongsTo(Container::class, 'container_id');
    }
}

