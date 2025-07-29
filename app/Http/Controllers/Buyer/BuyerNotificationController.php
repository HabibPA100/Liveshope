<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class BuyerNotificationController extends Controller
{
    public function show($id)
    {
        $buyer = Auth::guard('buyer')->user();

        // Buyer only accesses own notifications
        $notification = $buyer->notifications()->where('id', $id)->firstOrFail();

        // Mark as read if not already
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        // Pass to view (create this blade if needed)
        return view('frontend.buyer.notifications.show', compact('notification'));
    }
}
