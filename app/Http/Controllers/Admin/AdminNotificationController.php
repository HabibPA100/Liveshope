<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class AdminNotificationController extends Controller
{
    public function show($id)
    {
        $notification = auth('admin')->user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        // Mark as read
        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        $data = $notification->data;

        $qrCodePath = null;
        if (!empty($data['unique_order_id'])) {
            // এখানে find() এর বদলে where() ব্যবহার করতে হবে
            $order = Order::where('unique_order_id', $data['unique_order_id'])->first();
            $qrCodePath = $order?->qr_code_path;
        }

        // Extract cart items
        $cartItems = collect($data['cart'] ?? []);

        // Collect unique seller IDs
        $sellerIds = $cartItems->pluck('seller_id')->unique()->filter();

        // Fetch sellers as a map
        $sellers = Seller::whereIn('id', $sellerIds)->get()->keyBy('id');

        return view('frontend.admin.notifications.show', [
            'notification' => $notification,
            'data'         => $data,
            'cartItems'    => $cartItems,
            'sellers'      => $sellers,
            'qrCodePath'   => $qrCodePath, // এই লাইনে qrCodePath পাঠানো হচ্ছে
        ]);
    }

    public function downloadNotificationPdf($id)
    {
        $notification = auth('admin')->user()
            ->notifications()
            ->where('id', $id)
            ->firstOrFail();

        $data = $notification->data;

        // Fix: use same cart key as in 'show' method
        $cartItems = collect($data['cart'] ?? []);

        // Fix: fetch sellers
        $sellers = Seller::whereIn('id', $cartItems->pluck('seller_id'))->get()->keyBy('id');

        // ✅ Fix: Determine QR code path based on Order
        $qrCodePath = null;
        $qrCodeExists = false;

        if (!empty($data['unique_order_id'])) {
            $order = \App\Models\Order::where('unique_order_id', $data['unique_order_id'])->first();
            if ($order && $order->qr_code_path) {
                $qrCodePath = $order->qr_code_path; // e.g. qrcodes/abc123.png
                $qrCodeExists = file_exists(public_path('storage/' . $qrCodePath));
            }
        }

        // Optional: debug block
        // dd(compact('notification', 'data', 'cartItems', 'sellers', 'qrCodePath', 'qrCodeExists'));

        $pdf = PDF::loadView('frontend.admin.notifications.show-pdf', [
            'notification' => $notification,
            'data' => $data,
            'cartItems' => $cartItems,
            'sellers' => $sellers,
            'qrCodePath' => $qrCodePath,
            'qrCodeExists' => $qrCodeExists,
        ])
        ->setPaper('a4')
        ->setOption('margin-bottom', 10)
        ->setOption('enable-local-file-access', true);

         // ✅ Return with dynamic file name
        $fileName = ($data['unique_order_id'] ?? 'notification') . '.pdf';
        return $pdf->download($fileName);
    }

}
