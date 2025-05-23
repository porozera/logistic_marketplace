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
    public function container()
    {
        // return $this->belongsTo(Truck::class, 'truck_second_id');
        return $this->belongsTo(Container::class, 'container_id');
    }
}

