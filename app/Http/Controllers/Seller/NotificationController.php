<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function show($id)
    {
        $notification = auth('seller')->user()->notifications()->findOrFail($id);

        // Mark as read
        $notification->markAsRead();

        $product = $notification->data['product'] ?? null;
        $buyerName = $notification->data['buyer_name'] ?? 'অজানা ক্রেতা';
        $buyerPhone = $notification->data['buyer_phone'] ?? 'ফোন নাম্বার নেই';
        $orderTime = $notification->created_at->timezone('Asia/Dhaka')->format('d M Y, h:i A') ?? 'সময় নটিফিকেশন বাটনে দেখুন';
        
        $deliveryArea = 'অজানা এলাকা';
            if (!empty($notification->data['unique_order_id'])) {
                $order = Order::find($notification->data['unique_order_id']);
                $deliveryArea = $order?->delivery_address ?? 'অজানা এলাকা';
            }

        return view('frontend.seller.notifications.show', compact('product', 'buyerName', 'deliveryArea', 'buyerPhone', 'orderTime'));
    }
}
