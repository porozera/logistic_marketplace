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
        'container_id',
        'truck_first_id',
        'truck_second_id',
        'truck_id',
        'timestamp',
        'cargoType'
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
