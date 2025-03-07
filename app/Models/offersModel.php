<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class offersModel extends Model
{
    use HasFactory;

    protected $table = 'offers';

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
        'timestamp',
        'is_for_lsp',
        'is_for_customer',
    ];
}
