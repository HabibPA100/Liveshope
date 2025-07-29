<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Flash Message -->
    @if (session()->has('success'))
        <div class="mb-4 text-green-700 bg-green-100 border border-green-300 px-4 py-3 rounded" data-aos="fade-down">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-lg p-6 w-full max-w-3xl mx-auto" data-aos="zoom-in">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            {{ $isEdit ? 'Edit Admin User' : 'Create Admin User' }}
        </h2>

        <!-- Form -->
        <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}" class="space-y-5">
            <!-- প্রোফাইল ছবি -->
            <div>
                <label for="profile_image" class="block text-gray-700 font-medium mb-1">প্রোফাইল ছবি দিন</label>
                <input type="file" id="profile_image" name="profile_image" wire:model="profile_image"
                        class="w-full file:py-2 file:px-4 file:rounded file:border-0 file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200 mt-1" />
                @error('profile_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="name" class="block text-gray-700">Name</label>
                <input id="name" type="text" wire:model.defer="name"
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="Enter full name">
                @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" type="email" wire:model.defer="email"
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="example@example.com">
                @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="nid" class="block text-gray-700">NID</label>
                <input id="nid" type="text" wire:model.defer="nid"
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500"
                       placeholder="1234567890">
                @error('nid') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="dob" class="block text-gray-700">Date of Birth</label>
                <input id="dob" type="date" wire:model.defer="dob"
                       class="mt-1 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                @error('dob') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>

            @unless($isEdit)
                <div>
                    <label for="password" class="block text-gray-700">Password</label>
                    <input id="password" type="password" wire:model.defer="password"
                           class="mt-1 w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    @error('password') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
            @endunless

            <div class="flex items-center justify-between space-x-4 mt-6">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded transition-all duration-200">
                    {{ $isEdit ? 'Update' : 'Save' }}
                </button>

                @if ($isEdit)
                    <button type="button" wire:click="resetForm"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded">
                        Cancel
                    </button>
                @endif
            </div>
        </form>
    </div>
    
</div>
