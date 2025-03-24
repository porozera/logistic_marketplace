<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'name',
        'postalCode'
    ];
    public function cities()
    {
        return $this->hasMany(City::class, 'id_province');
    }
}
