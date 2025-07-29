<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SellerProductOrdered extends Notification
{
    use Queueable;

    public $product;

    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "আপনার প্রোডাক্ট '{$this->product['name']}' এর অর্ডার হয়েছে। অনুগ্রহ করে পণ্যটি এডমিনকে পৌছেদিন!",
            'product' => $this->product,
        ];
    }
}
