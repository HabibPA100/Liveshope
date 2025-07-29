<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Seller;
use Livewire\Component;
use App\Models\AdminUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AdminOrderSummary;
use App\Notifications\SellerProductOrdered;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Notifications\OrderPlacedNotification;
use App\Notifications\OrderPlacedNotificationToAdmin;
use App\Notifications\OrderPlacedNotificationToSeller;

class CartPage extends Component
{
    public $user_id;
    public $name;
    public $phone;
    public $delivery_address;
    public $order_note;

    public array $cart = [];

    public string $selectedDeliveryArea = 'ঢাকার ভিতরে';

    public array $deliveryOptions = [
        'ঢাকার ভিতরে' => ['label' => 'ঢাকার ভিতরে', 'charge' => 50],
        'ঢাকার পার্শ্ববর্তী এলাকা' => ['label' => 'ঢাকার পার্শ্ববর্তী এলাকা', 'charge' => 80],
        'ঢাকার বাহিরে' => ['label' => 'ঢাকার বাহিরে', 'charge' => 150],
    ];

    public function mount(): void
    {
        $this->cart = Session::get('cart', []);

        if ($user = Auth::user()) {
            $this->user_id = $user->id;
            $this->delivery_address = $user->address ?? '';
            $this->name = $user->name ?? '';
            $this->phone = $user->phone ?? '';
        }
    }

    public function getDeliveryChargeProperty(): int
    {
        return $this->deliveryOptions[$this->selectedDeliveryArea]['charge'] ?? 0;
    }

    public function getSubtotalProperty(): int
    {
        return collect($this->cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
    }

    public function increment(int $id): void
    {
        if (isset($this->cart[$id])) {
            $this->cart[$id]['quantity']++;
            $this->updateCart();
        }
    }

    public function decrement(int $id): void
    {
        if (isset($this->cart[$id]) && $this->cart[$id]['quantity'] > 1) {
            $this->cart[$id]['quantity']--;
            $this->updateCart();
        }
    }

    public function remove(int $id): void
    {
        unset($this->cart[$id]);
        $this->updateCart();
    }

    protected function updateCart(): void
    {
        Session::put('cart', $this->cart);

        $this->dispatch('cartUpdated');
    }
    

    public function placeOrder(): void
    {
        if (empty($this->cart)) {
            $this->dispatch('error', [
                'type' => 'error',
                'message' => 'কার্ট খালি!',
            ]);
            return;
        }

        // ইউনিক অর্ডার আইডি তৈরি
        $timestamp = Carbon::now('Asia/Dhaka')->format('Ymd-His'); // ফলাফল: 20250623-143025
        $generatedOrderId = 'ORD-' . $timestamp . '-' . strtoupper(Str::random(4));
        // dd($generatedOrderId); 

        // অর্ডার তৈরি 

        $buyer = Auth::user();
        // যদি ইউজার কিছু না লেখে তাহলে buyer table থেকে address ব্যবহার করো
        if (empty(trim($this->delivery_address)) && $buyer) {
            $this->delivery_address = $buyer->address ?? '';
        }

        $order = Order::create([
            'user_id'          => $buyer?->id,
            'name'            => $buyer?->name,
            'phone'            => $buyer?->phone,
            'delivery_address' => $this->delivery_address,
            'order_note'       => $this->order_note,
            'delivery_area'    => $this->selectedDeliveryArea,
            'delivery_charge'  => $this->deliveryCharge,
            'cart_items'       => $this->cart,
            'subtotal'         => $this->subtotal,
            'total'            => $this->subtotal + $this->deliveryCharge,
            'unique_order_id'  => $generatedOrderId,
            'qr_code_path'     => null,
        ]);

        $qrContent = "অর্ডার নম্বর: {$order->unique_order_id}\n"
           . "ফোন: {$order->phone}\n"
           . "মোট: " . ($order->total) . " টাকা\n"
           . "ডেলিভারি ঠিকানা: {$order->delivery_address}";

        $qrImage = QrCode::format('png')
            ->size(300)
            ->encoding('UTF-8') 
            ->generate($qrContent);

        $qrPath = "qrcodes/order-{$order->id}.png";
        Storage::disk('public')->put($qrPath, $qrImage);

        // QR কোড path আপডেট
        $order->update([
            'qr_code_path' => $qrPath,
        ]);

        // সেলার ও অ্যাডমিনদের নোটিফিকেশন পাঠানো 
        $sellerCache = [];

        foreach ($this->cart as $item) {
            $sellerId = $item['seller_id'] ?? null;

            if (empty($sellerId) || !is_numeric($sellerId)) continue;

            if (!isset($sellerCache[$sellerId])) {
                $sellerCache[$sellerId] = Seller::find($sellerId);
            }

            $seller = $sellerCache[$sellerId];

            if ($seller && $seller->email) {
                try {
                    $seller->notify(new SellerProductOrdered($item));

                    // ✅ এখানেই $order ইনজেক্ট করে দাও
                    $seller->notify(new OrderPlacedNotificationToSeller($item, $order));
                } catch (\Exception $e) {
                    Log::error("Notification failed for seller ID $sellerId: " . $e->getMessage());
                }
            }
        }

        $admins = AdminUser::all();
        $buyer = Auth::user();

         foreach ($admins as $admin) {
            try {
                // Admin-কে অর্ডার সারাংশের নোটিফিকেশন পাঠানো
                $admin->notify(new AdminOrderSummary(
                    $this->cart,
                    $order->total,
                    $order->id,
                    $order->unique_order_id,
                    $this->delivery_address,
                    $this->selectedDeliveryArea,
                    $buyer
                ));

                // Admin-কে ইমেইল অর্ডার প্লেস হওয়ার মেইল পাঠানো
                    $admin->notify(new OrderPlacedNotificationToAdmin($order));
                } catch (\Exception $e) {
                    Log::error("Admin notification/email failed for Admin ID {$admin->id}: " . $e->getMessage());
                }
            }

         try {
                if ($buyer && $buyer->email) {
                    $buyer->notify(new OrderPlacedNotification($order));
                }
            } catch (\Exception $e) {
                Log::error("Buyer email notification failed: " . $e->getMessage());
            }

        // ইনপুট রিসেট
        Session::forget('cart');
        $this->cart = [];
        $this->delivery_address = '';
        $this->order_note = '';
        $this->selectedDeliveryArea = 'ঢাকার ভিতরে';

        $this->dispatch('swal:info', data: [
            'title' => 'success',
            'text' => 'আপনার অর্ডার সফলভাবে গৃহীত হয়েছে।',
        ]);

    }

    public function render()
    {
        return view('livewire.cart-page');
    }
}
