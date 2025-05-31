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
        'lsp_id',
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
        $shippingDate = Carbon::parse($this->shippingDate);
        $estimationDate = Carbon::parse($this->estimationDate);
        return $shippingDate->diffInDays($estimationDate);
    }

    public function getLoadingDateFormattedAttribute()
    {
        return Carbon::parse($this->loadingDate)->translatedFormat('d F Y');
    }

    public function getShippingDateFormattedAttribute()
    {
        return Carbon::parse($this->shippingDate)->translatedFormat('d F Y');
    }

    public function getEstimationDateFormattedAttribute()
    {
        return Carbon::parse($this->estimationDate)->translatedFormat('d F Y');
    }

    public function lsp()
    {
        return $this->belongsTo(User::class, 'lsp_id');
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
