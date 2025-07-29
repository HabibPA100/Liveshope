<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserLogin extends Component
{
    public $email, $password, $userType;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
        'userType' => 'required|in:buyer,seller,admin',
    ];

    public function mount()
    {
        if (Auth::guard('buyer')->check()) {
            return redirect()->route('buyer.dashboard');
        }

        if (Auth::guard('seller')->check()) {
            return redirect()->route('seller.dashboard');
        }

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
    }

    public function login()
    {
        $this->validate();

        switch ($this->userType) {
            case 'buyer':
                if (Auth::guard('buyer')->attempt(['email' => $this->email, 'password' => $this->password])) {
                    session()->flash('success', 'Buyer Login successful!');
                    return redirect()->route('buyer.dashboard');
                }
                break;

            case 'seller':
                if (Auth::guard('seller')->attempt(['email' => $this->email, 'password' => $this->password])) {
                    session()->flash('success', 'Seller Login successful!');
                    return redirect()->route('seller.dashboard');
                }
                break;

            case 'admin':
                if (Auth::guard('admin')->attempt([
                    'email' => $this->email,
                    'password' => $this->password,
                    'is_admin' => true,
                ])) {
                    session()->flash('success', 'Admin Login successful!');
                    return redirect()->route('admin.dashboard');
                }
                break;
        }

        session()->flash('error', 'Invalid credentials.');
    }

    public function render()
    {
        return view('livewire.user-login');
    }
}
