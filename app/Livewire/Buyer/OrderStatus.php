<?php

namespace App\Livewire\Buyer;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderStatus extends Component
{
    public $orders;

    // স্ট্যাটাস ধাপ গুলো (ব্যবহার করবো view তে)
    public $statusSteps = [
        'confirmed',     // Step 1
        'processing',    // Step 2
        'shipped',       // Step 3
        'on_the_way',    // Step 4
        'delivered'      // Step 5
    ];

    public function getOrders()
    {
        $this->orders = Order::where('user_id', Auth::id())
                            ->latest()
                            ->get()
                            ->map(function ($order) {
                                // status index বের করা (0-4)
                                $order->currentStep = array_search($order->status, $this->statusSteps);
                                return $order;
                            });
    }

    public function mount()
    {
        $this->getOrders();
    }

    public function render()
    {
        return view('livewire.buyer.order-status', [
            'statusSteps' => $this->statusSteps, // View এ পাঠানোর জন্য
        ]);
    }

    public function refreshOrders()
    {
        $this->getOrders(); // Auto-polling for updates
    }
}
