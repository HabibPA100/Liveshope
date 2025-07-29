<?php

namespace App\Livewire\Buyer;

use App\Models\Buyer;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BuyerRegistration extends Component
{
    use WithFileUploads;

    public $name, $email, $password, $password_confirmation, $phone, $address, $profile_image, $terms;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:buyers,email',
        'password' => 'required|confirmed|min:8',
        'phone' => 'required|string|min:10',
        'address' => 'required|string|max:500',
        'profile_image' => 'nullable|image|mimes:jpg,png,jpeg|max:3072',
        'terms' => 'accepted'
    ];

    public function register()
    {
        $this->validate();

        if ($this->profile_image) {
            $imageName = time() . '.' . $this->profile_image->getClientOriginalExtension();
            $this->profile_image->storeAs('buyers', $imageName, 'public');
            $imagePath = 'buyers/' . $imageName;
        } else {
            $imagePath = null;
        }

       $buyer = Buyer::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'phone' => $this->phone,
            'address' => $this->address,
            'profile_image' => $imagePath,
        ]);

        // Auto login using buyer guard
        Auth::guard('buyer')->login($buyer);

        // রিডাইরেক্ট টু ড্যাশবোর্ড
        return $this->redirect(route('buyer.dashboard'));
    }

    public function render()
    {
        return view('livewire.buyer.buyer-registration');
    }
}
