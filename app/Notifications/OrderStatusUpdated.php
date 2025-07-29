<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OrderStatusUpdated extends Notification
{
    use Queueable;

    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database']; // আপনি চাইলে 'mail', 'broadcast' ইত্যাদিও যোগ করতে পারেন
    }

    public function toArray($notifiable)
    {
        $messages = [
            'confirmed' => 'আপনার অর্ডারটি কনফার্ম করা হয়েছে।',
            'processing' => 'আপনার অর্ডারটি প্রক্রিয়াধীন রয়েছে।',
            'shipped' => 'আপনার অর্ডারটি পাঠানো হয়েছে।',
            'on_the_way' => 'আপনার অর্ডারটি রাস্তায় আছে।',
            'delivered' => 'আপনার অর্ডারটি ডেলিভার করা হয়েছে।',
            'cancelled' => 'আপনার অর্ডারটি বাতিল করা হয়েছে।',
        ];

        return [
            'message' => $messages[$this->status] ?? 'আপনার অর্ডারের স্ট্যাটাস আপডেট হয়েছে।',
            'status' => $this->status,
        ];
    }
}
