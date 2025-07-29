<!-- resources/views/livewire/colorful-register-form.blade.php -->

<div class="min-h-screen flex items-center justify-center bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 p-6">
    <div class="w-full max-w-xl bg-white bg-opacity-90 backdrop-blur-md shadow-2xl rounded-xl p-8" data-aos="fade-up" data-aos-duration="1000">

        @if (session()->has('success'))
            <div class="mb-4 p-4 rounded bg-green-100 text-green-800 shadow" data-aos="fade-down">
                {{ session('success') }}
            </div>
        @endif

        <h2 class="text-3xl font-bold text-center text-gray-800 mb-6">আমি পণ্য কিনতে চাই ?</h2>

        <form wire:submit.prevent="register" class="space-y-5" data-aos="zoom-in" data-aos-delay="200">
            <!-- সম্পূর্ণ নাম -->
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-1">সম্পূর্ণ নামঃ</label>
                <input type="text" id="name" name="name" wire:model="name"
                       placeholder="আপনার নাম লিখুন"
                       autocomplete="name"
                       required
                       class="w-full px-4 py-3 rounded-md bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition shadow-sm hover:shadow-md" />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- ইমেইল -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">ইমেইলঃ</label>
                <input type="email" id="email" name="email" wire:model="email"
                       placeholder="example@email.com"
                       autocomplete="email"
                       required
                       class="w-full px-4 py-3 rounded-md bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition shadow-sm hover:shadow-md" />
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- ফোন নাম্বার -->
            <div>
                <label for="phone" class="block text-gray-700 font-medium mb-1">ফোন নাম্বার</label>
                <input type="tel" id="phone" name="phone" wire:model="phone"
                       placeholder="০১XXXXXXXXX"
                       autocomplete="tel"
                       required
                       class="w-full px-4 py-3 rounded-md bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition shadow-sm hover:shadow-md" />
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- ঠিকানা -->
            <div>
                <label for="address" class="block text-gray-700 font-medium mb-1">যে ঠিকানায় পণ্য নিতে চান:</label>
                <textarea id="address" name="address" wire:model="address" rows="3"
                          placeholder="উদাহরণ: বাড়ি #১২৩, রোড #৪, ধানমন্ডি, ঢাকা-১২০৯"
                          autocomplete="street-address"
                          required
                          class="w-full px-4 py-3 rounded-md bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition shadow-sm hover:shadow-md"></textarea>
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- পাসওয়ার্ড -->
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">একটি পাসওয়ার্ড দিন</label>
                <input type="password" id="password" name="password" wire:model="password"
                       placeholder="কমপক্ষে ৮ অক্ষরের পাসওয়ার্ড দিন"
                       autocomplete="new-password"
                       required
                       class="w-full px-4 py-3 rounded-md bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition shadow-sm hover:shadow-md" />
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- পাসওয়ার্ড নিশ্চিত -->
            <div>
                <label for="password_confirmation" class="block text-gray-700 font-medium mb-1">পাসওয়ার্ড পুনরায় দিন</label>
                <input type="password" id="password_confirmation" name="password_confirmation" wire:model="password_confirmation"
                       placeholder="পাসওয়ার্ড আবার লিখুন"
                       autocomplete="new-password"
                       required
                       class="w-full px-4 py-3 rounded-md bg-white border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400 transition shadow-sm hover:shadow-md" />
            </div>

            <!-- প্রোফাইল ছবি -->
            <div>
                <label for="profile_image" class="block text-gray-700 font-medium mb-1">প্রোফাইল ছবি দিন</label>
                <input type="file" id="profile_image" name="profile_image" wire:model="profile_image"
                       class="w-full file:py-2 file:px-4 file:rounded file:border-0 file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200 mt-1" />
                @error('profile_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <!-- শর্তাবলী -->
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="terms" name="terms" wire:model="terms"
                       class="text-pink-500 focus:ring-pink-400 rounded border-gray-300" />
                <label for="terms" class="text-sm text-gray-600">
                    আমি <a href="#" class="text-pink-600 hover:underline">শর্তাবলীতে</a> সম্মত
                </label>
            </div>
            @error('terms') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

            <!-- সাবমিট বাটন -->
            <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-pink-500 to-purple-500 hover:from-pink-600 hover:to-purple-600 text-white font-bold rounded-md shadow-lg transform hover:scale-105 transition duration-300">
                একাউন্ট খুলুন
            </button>
        </form>
        <p class="mt-4 text-center text-gray-600">
            Already Have Account <a href="{{ route('login') }}" class="text-blue-600 hover:underline">লগইন করুন</a>
        </p>
    </div>
</div>
