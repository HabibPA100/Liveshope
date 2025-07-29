<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'payment_number',
        'trx_id',
        'amount',
        'status',
        'start_date',
        'end_date',
    ]; 

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'user_id');
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_id');
    }
}
