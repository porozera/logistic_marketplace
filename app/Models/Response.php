<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $fillable = [
        'complain_id',
        'user_id', 
        'response'
    ];

    public function complain()
    {
        return $this->belongsTo(Complain::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
