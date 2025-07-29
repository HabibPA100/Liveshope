<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPlacedNotificationToAdmin extends Notification
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
            ->subject('নতুন অর্ডার এসেছে অনুগ্রহ করে চেক দিন')
            ->greeting("হ্যালো {$notifiable->name},")
            ->line("আপনার কাছে একটি নতুন অর্ডার আছে!")
            ->line("অর্ডার নম্বর: {$this->order->unique_order_id}")
            ->line("মোট পরিমাণ: {$this->order->total} টাকা")
            ->line("ডেলিভারি ঠিকানা: {$this->order->delivery_address}")
            ->line('অনুগ্রহ করে দ্রুত সময়ের মাঝে ডেলিভারি নিশ্চিত করুন।');
    }
}
