<?php

namespace App\Http\Controllers\Admin;

use App\Models\Buyer;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\OrderStatusUpdated;

class EditProductStatusController extends Controller
{
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:confirmed,processing,shipped,on_the_way,delivered,cancelled'
        ]);

        $order->status = $request->status;
        $order->save();

        // রিলেশন ছাড়া notification পাঠানো হচ্ছে
        $user = Buyer::find($order->user_id); // রিলেশন ছাড়াই buyer খুঁজে আনা
        if ($user) {
            $user->notify(new OrderStatusUpdated($request->status));
        }

        return back()->with('success', 'অর্ডার স্ট্যাটাস সফলভাবে আপডেট হয়েছে!');
    }

}
