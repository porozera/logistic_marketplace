<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;

    protected $table = 'complains';

    protected $fillable = [
        'user_id',
        'description',
        'header',
        'answer',
        'email',
        'is_answered',
    ];

    protected $casts = [
        'is_answered' => 'boolean',
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
