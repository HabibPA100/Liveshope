<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
class Buyer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'profile_image',
    ];

    protected $hidden = ['password'];

    public function sendPasswordResetNotification($token)
    {
        $url = url("/password/buyer/reset/{$token}?email=" . urlencode($this->email));
        $this->notify(new ResetPasswordNotification($url));
    }
}
