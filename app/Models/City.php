<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'id_province',
        'name',
        'postalCode'
    ];
    public function province() {
        return $this->belongsTo(Province::class, 'id_province');
    }
}
