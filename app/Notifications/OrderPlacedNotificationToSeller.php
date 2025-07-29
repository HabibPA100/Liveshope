<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPlacedNotificationToSeller extends Notification
{
    use Queueable;

    public $item;
    public $order;

    public function __construct($item, $order)
    {
        $this->item = $item;
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('নতুন অর্ডার পেয়েছেন')
            ->greeting("হ্যালো {$notifiable->name},")
            ->line("আপনার পণ্যের একটি নতুন অর্ডার এসেছে!")
            ->line("অর্ডার নম্বর: {$this->order->unique_order_id}")
            ->line("পণ্যের নাম: {$this->item['name']}")
            ->line("পরিমাণ: {$this->item['quantity']} টি")
            ->line("ডেলিভারি ঠিকানা: {$this->order->delivery_area}")
            ->line("মোট: " . number_format($this->item['price'] * $this->item['quantity'], 2) . " টাকা")
            ->line('অনুগ্রহ করে দ্রুত পণ্য এডমিন কে পৌছেদিন!');
    }
}
