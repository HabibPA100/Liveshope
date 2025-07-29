<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SellerNotificationBell extends Component
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
        $seller = Auth::guard('seller')->user();
        if (!$seller) {
            $this->notifications = [];
            $this->unreadCount = 0;
            return;
        }

        $this->notifications = $seller->notifications()->latest()->take(10)->get();
        $this->unreadCount = $seller->unreadNotifications()->count();
    }

    public function markAsRead($notificationId)
    {
        $seller = Auth::guard('seller')->user();
        if (!$seller) return;

        $notification = $seller->notifications()->where('id', $notificationId)->first();
        if ($notification && is_null($notification->read_at)) {
            $notification->markAsRead();
            $this->loadNotifications();
        }
    }

    public function toggleDropdown()
    {
        $this->showDropdown = !$this->showDropdown;
    }

    public function render()
    {
        return view('livewire.seller.seller-notification-bell');
    }
}
