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
        'user_id',
        'is_for_lsp',
        'is_for_customer',
        'truck_id',
        'timestamp',
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
