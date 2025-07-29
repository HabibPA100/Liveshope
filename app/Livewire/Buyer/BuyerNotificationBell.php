<?php

namespace App\Livewire\Buyer;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class BuyerNotificationBell extends Component
{
    public $notifications = [];
    public $unreadCount = 0;
    public $showDropdown = false;

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        $buyer = Auth::guard('web')->user(); // web guard ধরে নেওয়া হয়েছে (default buyer)
        if (!$buyer) {
            $this->notifications = [];
            $this->unreadCount = 0;
            return;
        }

        $this->notifications = $buyer->notifications()->latest()->take(10)->get();
        $this->unreadCount = $buyer->unreadNotifications()->count();
    }

    public function markAsRead($notificationId)
    {
        $buyer = Auth::guard('web')->user();
        if (!$buyer) return;

        $notification = $buyer->notifications()->where('id', $notificationId)->first();
        if ($notification && is_null($notification->read_at)) {
            $notification->markAsRead();
            $this->loadNotifications();
        }
    }

    public function markAllAsRead()
    {
        $buyer = Auth::guard('web')->user();
        if ($buyer) {
            $buyer->unreadNotifications->markAsRead();
            $this->loadNotifications();
        }
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function render()
    {
        return view('livewire.buyer.buyer-notification-bell');
    }
}
