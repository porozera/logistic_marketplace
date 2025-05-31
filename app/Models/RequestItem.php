<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class RequestItem extends Model
{
   use HasFactory;

    protected $table = 'request_items';
    public $timestamps = true;
    protected $fillable = [
        'requestOffer_id',
        'volume',
        'weight',
        'length',
        'height',
        'width',
        'qty',
        'commodities',
    ];

    public function requestOffer()
    {
        return $this->belongsTo(RequestRoute::class, 'requestOffer_id');
    }
}
