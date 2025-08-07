<?php

namespace App\Livewire\Seller;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class SellerProfileEdit extends Component
{
    use WithFileUploads;

    public $profile_image, $name, $email, $store_name, $phone, $address, $national_id, $date_of_birth;
    public $old_profile_image_path;

    public function mount()
    {
        $seller = Auth::guard('seller')->user();

        $this->name = $seller->name;
        $this->email = $seller->email;
        $this->store_name = $seller->store_name;
        $this->phone = $seller->phone;
        $this->address = $seller->address;
        $this->national_id = $seller->national_id;
        $this->date_of_birth = $seller->date_of_birth;
        $this->old_profile_image_path = $seller->profile_image; // পুরানো ছবি দেখানোর জন্য
    }

    public function updateProfile()
    {
        $seller = Auth::guard('seller')->user();

        $this->validate([
            'profile_image'      => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'name'               => 'required|string|max:100',
            'email'              => 'required|email|unique:sellers,email,' . $seller->id,
            'store_name'         => 'nullable|string|max:100',
            'phone'              => 'required|string|min:10|max:15',
            'address'            => 'required|string|max:255',
            'national_id'        => 'required|numeric|digits_between:10,17|unique:sellers,national_id,' . $seller->id,
            'date_of_birth'      => 'required|date|before:today',
        ]);

        if ($this->profile_image) {
            $imageName = time() . '.' . $this->profile_image->getClientOriginalExtension();
            $this->profile_image->storeAs('sellers', $imageName, 'public');
            $seller->profile_image = 'sellers/' . $imageName;
        }

        $seller->name = $this->name;
        $seller->email = $this->email;
        $seller->store_name = $this->store_name;
        $seller->phone = $this->phone;
        $seller->address = $this->address;
        $seller->national_id = $this->national_id;
        $seller->date_of_birth = $this->date_of_birth;

        $seller->save();

        $this->dispatch('swal:success', data: [
            'title' => $this->name,
            'text' => 'আপনি সফলভাবে Profile Update করেছেন ধন্যবাদ।',
        ]);

    }

    public function render()
    {
        return view('livewire.seller.seller-profile-edit');
    }
}
