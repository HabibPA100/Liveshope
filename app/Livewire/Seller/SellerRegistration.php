<?php

namespace App\Livewire\Seller;

use App\Models\Seller;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Rules\UniqueEmailAcrossTables;

class SellerRegistration extends Component
{
    use WithFileUploads;

    public $profile_image;
    public $name, $email, $password, $password_confirmation,
           $store_name, $phone, $address, $national_id, $date_of_birth, $status;

    public function submit()
    {
        $this->validate([
            'profile_image'      => 'nullable|image|mimes:jpg,jpeg,png|max:3072',
            'name'               => 'required|string|max:100',
            'email'              => ['required', 'email', new UniqueEmailAcrossTables()],
            'password'           => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'store_name'         => 'nullable|string|max:100',
            'phone'              => 'required|string|min:10|max:15',
            'address'            => 'required|string|max:255',
            'national_id'        => 'required|numeric|unique:sellers,national_id|digits_between:10,17',
            'date_of_birth'      => 'required|date|before:today',
        ]);

        // Image upload
        $imagePath = null;
        if ($this->profile_image) {
            $imageName = time() . '.' . $this->profile_image->getClientOriginalExtension();
            $this->profile_image->storeAs('sellers', $imageName, 'public');
            $imagePath = 'sellers/' . $imageName;
        }

        // Save Seller
       $seller = Seller::create([
            'name'          => $this->name,
            'email'         => $this->email,
            'password'      => Hash::make($this->password),
            'store_name'    => $this->store_name,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'national_id'   => $this->national_id,
            'date_of_birth' => $this->date_of_birth,
            'profile_image' => $imagePath,
            'status'        => 'Approved',
        ]);

         // Auto login using buyer guard
        Auth::guard('seller')->login($seller);

        // রিডাইরেক্ট টু ড্যাশবোর্ড
        return $this->redirect(route('seller.dashboard'));
    }

    public function render()
    {
        return view('livewire.seller.seller-registration');
    }
}
