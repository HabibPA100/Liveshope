<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ContactSummary extends Notification
{
    use Queueable;

    public $name;
    public $email;
    public $message;

    public function __construct($name, $email, $message)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
    }

    public function via($notifiable)
    {
        return ['mail']; // চাইলে database, sms ইত্যাদি যোগ করতে পারেন
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('নতুন কনট্যাক্ট ফর্ম সাবমিশন')
                    ->greeting('হ্যালো, অ্যাডমিন!')
                    ->line('একজন ইউজার কনট্যাক্ট ফর্ম পূরণ করেছে। নিচে বিস্তারিত:')
                    ->line('নাম: ' . $this->name)
                    ->line('ইমেইল: ' . $this->email)
                    ->line('বার্তা: ' . $this->message)
                    ->line('ধন্যবাদ।');
    }
}
