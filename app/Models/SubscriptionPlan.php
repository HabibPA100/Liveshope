<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    protected $fillable = ['duration', 'price', 'tag', 'highlight'];

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'subscription_id');
    }
}
