<?php

namespace App\Models;

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
        'requestOffer_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function requestRoute()
    {
        return $this->belongsTo(RequestRoute::class, 'requestOffer_id');
    }
}

