<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class BuyerOrderListPDFController extends Controller
{
    // Admin panel view – অর্ডার ফর্ম তালিকা
    public function index()
    {
        $orders = Order::latest()->get();

        // আমরা সব orders পাঠাচ্ছি, cart_items view এর ভিতরে handle করবো
        return view('frontend.admin.buyer-order-list', compact('orders'));
    }

    // নির্দিষ্ট অর্ডারের PDF ডাউনলোড
    public function downloadOrderForm($id)
    {
        $order = Order::findOrFail($id);

       $qrCodePath = null;

        if (!empty($order->qr_code_path)) {
            $path = public_path('storage/' . $order->qr_code_path);
            if (file_exists($path)) {
                $qrCodePath = $path;
            }
        }

        $cartItems = is_string($order->cart_items)
            ? json_decode($order->cart_items, true)
            : $order->cart_items;

        $pdf = PDF::loadView('frontend.admin.pdf-buyer-order-list', [
            'order' => $order,
            'qrCodePath' => $qrCodePath,
            'cartItems' => $cartItems,
        ])
        ->setOption('enable-local-file-access', true);

        return $pdf->download("Buyer-{$order->unique_order_id}.pdf");
    }

}
