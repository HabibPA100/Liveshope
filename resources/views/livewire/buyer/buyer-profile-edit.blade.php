<div class="max-w-2xl mx-auto p-4">

    @if(session()->has('message'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="updateProfile" enctype="multipart/form-data" class="space-y-4">

        <div>
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" wire:model.defer="name" class="w-full border rounded p-2" />
            @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Email</label>
            <input type="email" wire:model.defer="email" class="w-full border rounded p-2" />
            @error('email') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Phone</label>
            <input type="text" wire:model.defer="phone" class="w-full border rounded p-2" />
            @error('phone') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Address</label>
            <textarea wire:model.defer="address" class="w-full border rounded p-2"></textarea>
            @error('address') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block mb-1 font-semibold">Profile Image</label>
            @if ($profile_image)
                <img src="{{ $profile_image->temporaryUrl() }}" alt="Preview" class="w-24 h-24 rounded object-cover mb-2" />
            @elseif($old_profile_image_path)
                <img src="{{ asset('storage/' . $old_profile_image_path) }}" alt="Profile Image" class="w-24 h-24 rounded object-cover mb-2" />
            @endif
            <input type="file" wire:model="profile_image" />
            @error('profile_image') <span class="text-red-600">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Profile</button>
    </form>

</div>
