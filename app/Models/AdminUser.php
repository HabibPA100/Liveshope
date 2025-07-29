<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;

class AdminUser extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $table = 'admin_user';

    protected $fillable = [
        'profile_image',
        'name',
        'email',
        'password',
        'is_admin',
        'nid',
        'dob',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'nid', // optional: hide sensitive information
    ];

    public function sendPasswordResetNotification($token)
    {
        $url = url("/password/admin/reset/{$token}?email=" . urlencode($this->email));
        $this->notify(new ResetPasswordNotification($url));
    }

}
