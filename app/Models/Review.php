<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'lsp_id',
        'order_id',
        'description',
        'ratingNumber',
    ];

    /**
     * Relasi ke model User sebagai customer.
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Relasi ke model User sebagai penyedia layanan (LSP).
     */
    public function lsp()
    {
        return $this->belongsTo(User::class, 'lsp_id');
    }

    /**
     * Relasi ke model Order.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
