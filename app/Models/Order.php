<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'delivery_address',
        'order_note',
        'name',
        'phone',
        'delivery_area',
        'delivery_charge',
        'cart_items',
        'subtotal',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'unique_order_id',
        'qr_code_path',
        'tracking_code',
        'canceled_at',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'cart_items'    => 'array',
        'canceled_at'   => 'datetime',
        'shipped_at'    => 'datetime',
        'delivered_at'  => 'datetime',
    ];

    /**
     * Optional: Define relationship with User if applicable
     */
    
}
