<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminOrderSummary extends Notification
{
    use Queueable;

    public $cart;
    public $total;
    public $orderId;
    public $uniqueOrderId;
    public $delivery_address;
    public $selectedDeliveryArea;
    public $buyer;

    /**
     * Create a new notification instance.
     */
    public function __construct($cart, $total, $orderId, $uniqueOrderId, $delivery_address, $selectedDeliveryArea, $buyer)
    {
        $this->cart           = $cart;
        $this->total          = $total;
        $this->orderId        = $orderId;
        $this->uniqueOrderId  = $uniqueOrderId;
        $this->delivery_address  = $delivery_address;
        $this->selectedDeliveryArea          = $selectedDeliveryArea;
        $this->buyer          = $buyer;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification for storage in database.
     */
    public function toDatabase($notifiable)
    {
        return [
            'message'          => 'নতুন অর্ডার এসেছে',
            'cart'             => $this->cart,
            'total'            => $this->total,
            'order_id'         => $this->orderId,
            'unique_order_id'  => $this->uniqueOrderId,
            'delivery_address' => $this->delivery_address,
            'delivery_area'    => $this->selectedDeliveryArea,
            'buyer'            => [
                'name'   => $this->buyer->name ?? 'N/A',
                'email'  => $this->buyer->email ?? 'N/A',
                'phone'  => $this->buyer->phone ?? 'N/A',
            ],
        ];
    }
}
