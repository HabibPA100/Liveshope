<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function dashboard()
    {
        $user = Auth::guard('seller')->user();
        
        $allProduct = Product::where('seller_id', $user->id)->count();

         // সব অর্ডার আনুন যেগুলোর cart_items-এ seller_id মিলে
        $orders = Order::get()->filter(function ($order) use ($user) {
            $items = is_array($order->cart_items) ? $order->cart_items : json_decode($order->cart_items, true);

            foreach ($items as $item) {
                if (isset($item['seller_id']) && $item['seller_id'] == $user->id) {
                    return true; // seller এর পণ্য আছে
                }
            }
            return false;
        });

        return view('frontend.seller.seller-dashboard', compact('user', 'allProduct', 'orders'));
    }
}
