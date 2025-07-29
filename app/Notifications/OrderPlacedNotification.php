<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('নতুন অর্ডার নিশ্চিত হয়েছে')
            ->greeting("হ্যালো {$notifiable->name},")
            ->line("আপনার অর্ডারটি সফলভাবে গৃহীত হয়েছে।")
            ->line("অর্ডার নম্বর: {$this->order->unique_order_id}")
            ->line("মোট পরিমাণ: {$this->order->total} টাকা")
            ->line("ডেলিভারি ঠিকানা: {$this->order->delivery_address}")
            ->line('ধন্যবাদ আমাদের সার্ভিস ব্যবহার করার জন্য!');
    }
}
