<?php

namespace App\Livewire\Buyer;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class BuyerProfileEdit extends Component
{
    use WithFileUploads;

    public $name, $email, $phone, $address, $profile_image;
    public $old_profile_image_path;

    public function mount()
    {
        $buyer = Auth::guard('buyer')->user();

        $this->name = $buyer->name;
        $this->email = $buyer->email;
        $this->phone = $buyer->phone;
        $this->address = $buyer->address;
        $this->old_profile_image_path = $buyer->profile_image;
    }

    public function updateProfile()
    {
        $buyer = Auth::guard('buyer')->user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:buyers,email,' . $buyer->id,
            'phone' => 'required|string|min:10',
            'address' => 'required|string|max:500',
            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg|max:3072',
        ]);

        if ($this->profile_image) {
            $imageName = time() . '.' . $this->profile_image->getClientOriginalExtension();
            $this->profile_image->storeAs('buyers', $imageName, 'public');
            $buyer->profile_image = 'buyers/' . $imageName;
        }

        $buyer->name = $this->name;
        $buyer->email = $this->email;
        $buyer->phone = $this->phone;
        $buyer->address = $this->address;

        $buyer->save();

        session()->flash('message', 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.buyer.buyer-profile-edit');
    }
}
