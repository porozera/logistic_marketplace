<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ServiceOrdered extends Model
{
   use HasFactory;

    protected $table = 'service_ordered';
    public $timestamps = true;
    protected $fillable = [
        'userOrder_id',
        'service_id'
    ];

    public function userOrder()
    {
        return $this->belongsTo(UserOrder::class, 'userOrder_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
