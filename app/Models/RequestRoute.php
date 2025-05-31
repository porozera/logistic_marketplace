<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestRoute extends Model
{
    protected $table = 'request_routes';
    public $timestamps = true;
    protected $fillable = [
        'user_id',
        'origin',
        'destination',
        'shipmentType',
        'shipmentMode',
        'transportationMode',
        'arrivalDate',
        'description',
        'status',
        'deadline',
        'cargoType',
        'container_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
