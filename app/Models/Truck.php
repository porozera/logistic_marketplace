<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;

    protected $table = 'trucks';

    protected $fillable = [
        'user_id',
        'plateNumber',
        'type',
        'brand',
        'yearBuilt',
        'driverName',
        'driverContact',
        'color',
        'timestamp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
