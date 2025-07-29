<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AdminNotificationBell extends Component
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
        $admin = Auth::guard('admin')->user();
        if (!$admin) {
            $this->notifications = [];
            $this->unreadCount = 0;
            return;
        }

        $this->notifications = $admin->notifications()->latest()->take(10)->get();
        $this->unreadCount = $admin->unreadNotifications()->count();
    }

    public function markAsRead($notificationId)
    {
        $admin = Auth::guard('admin')->user();
        if (!$admin) return;

        $notification = $admin->notifications()->where('id', $notificationId)->first();
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
        return view('livewire.admin.admin-notification-bell');
    }
}
