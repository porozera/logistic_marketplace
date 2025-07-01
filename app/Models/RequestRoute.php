<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
        'container_id',
        'RTL_start_date',
        'RTL_end_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getarrivalDate()
    {
        if (!$this->arrivalDate) {
        return 'Tidak ada informasi tanggal';
        }
        return Carbon::parse($this->arrivalDate)->translatedFormat('d F Y');
    }
}
