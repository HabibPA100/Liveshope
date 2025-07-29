<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Database\Eloquent\Prunable;

class CustomNotification extends DatabaseNotification
{
    use Prunable;

    /**
     * পুরনো notifications গুলো return করবে
     */
    public function prunable()
    {
        return static::where('created_at', '<', now()->subDays(4));
    }
}
