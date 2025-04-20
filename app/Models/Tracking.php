<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $table = 'tracking';
    public $timestamps = true;
    protected $fillable = [
        'order_id',
        'currentLocation',
        'currentVehicle',
        'status',
        'description',
        'longitude',
        'latitude',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
