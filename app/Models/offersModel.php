<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class offersModel extends Model
{
    use HasFactory;

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'container_id',
        'truck_first_id',
        'truck_second_id',
        'noOffer',
        'origin',
        'destination',
        'portOrigin',
        'portDestination',
        'transportationMode',
        'shipmentMode',
        'shipmentType',
        'maxWeight',
        'maxVolume',
        'remainingWeight',
        'remainingVolume',
        'cargoType',
        'status',
        'price',
        'pickupDate',
        'departureDate',
        'cyClosingDate',
        'etd',
        'eta',
        'deliveryDate',
        'arrivalDate',
        'is_for_lsp',
        'is_for_customer',
    ];

    // protected $attributes = [
    //     'user_id' => 1, // Contoh user_id sementara

    // ];

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function truck_first()
    {
        return $this->belongsTo(Truck::class, 'truck_first_id');
    }

    public function truck_second()
    {
        return $this->belongsTo(Truck::class, 'truck_second_id');
    }

    public function container()
    {
        return $this->belongsTo(Container::class, 'container_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'commodities');
    }
}
