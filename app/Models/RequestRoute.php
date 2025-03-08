<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestRoute extends Model
{
    protected $table = 'request_routes';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'username',
        'origin',
        'destination',
        'shipmentType',
        'shipmentMode',
        'shippingDate',
        'weight',
        'volume',
        'commodities',
        'description',
        'status',
        'deadline'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
