<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

class Seller extends Authenticatable
{
    use Notifiable;

    protected $table = 'sellers';
    
    protected $fillable = [
        'name',
        'profile_image',
        'email',
        'password',
        'store_name',
        'phone',
        'address',
        'national_id',
        'date_of_birth',
        'status',
    ];

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'user_id');
    }

    public function sendPasswordResetNotification($token)
    {
        $url = url("/password/seller/reset/{$token}?email=" . urlencode($this->email));
        $this->notify(new ResetPasswordNotification($url));
    }

}
