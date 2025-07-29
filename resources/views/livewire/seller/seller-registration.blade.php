<div class="max-w-2xl mx-auto mt-10 p-8 bg-gradient-to-br from-white via-blue-50 to-white rounded-xl shadow-lg border border-blue-100">

    @if (session()->has('success'))
        <div class="mb-6 text-green-800 bg-green-100 p-4 rounded-lg shadow-sm animate-pulse">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        <h2 class="text-3xl font-bold text-center text-blue-700 mb-6">সেলার রেজিস্ট্রেশন ফর্ম</h2>

        <!-- পূর্ণ নাম -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">পূর্ণ নাম</label>
            <input type="text" id="name" name="name" wire:model="name"
                   autocomplete="name" placeholder="আপনার পূর্ণ নাম লিখুন"
                   class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <!-- প্রোফাইল ছবি -->
        <div>
            <label for="profile_image" class="block text-gray-700 font-medium mb-1">প্রোফাইল ছবি দিন</label>
            <input type="file" id="profile_image" name="profile_image" wire:model="profile_image"
                    class="w-full file:py-2 file:px-4 file:rounded file:border-0 file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200 mt-1" />
            @error('profile_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- ইমেইল -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">ইমেইল ঠিকানা</label>
            <input type="email" id="email" name="email" wire:model="email"
                   autocomplete="email" placeholder="আপনার ইমেইল লিখুন"
                   class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- পাসওয়ার্ড -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">পাসওয়ার্ড</label>
            <input type="password" id="password" name="password" wire:model="password"
                   autocomplete="new-password" placeholder="পাসওয়ার্ড টাইপ করুন"
                   class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- পাসওয়ার্ড নিশ্চিত করুন -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">পাসওয়ার্ড নিশ্চিত করুন</label>
            <input type="password" id="password_confirmation" name="password_confirmation" wire:model="password_confirmation"
                   autocomplete="new-password" placeholder="পুনরায় পাসওয়ার্ড দিন"
                   class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('password_confirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- দোকানের নাম -->
        <div>
            <label for="store_name" class="block text-sm font-medium text-gray-700">দোকানের নাম</label>
            <input type="text" id="store_name" name="store_name" wire:model="store_name"
                   autocomplete="off" placeholder="আপনার দোকানের নাম লিখুন"
                   class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('store_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- মোবাইল নাম্বার -->
        <div>
            <label for="phone" class="block text-sm font-medium text-gray-700">মোবাইল নাম্বার</label>
            <input type="tel" id="phone" name="phone" wire:model="phone"
                   autocomplete="tel" placeholder="১১ ডিজিটের মোবাইল নাম্বার লিখুন"
                   class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- ঠিকানা -->
        <div>
            <label for="address" class="block text-sm font-medium text-gray-700">ঠিকানা</label>
            <textarea id="address" name="address" wire:model="address"
                      autocomplete="street-address" placeholder="আপনার ঠিকানা লিখুন"
                      class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 resize-none h-24"></textarea>
            @error('address') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- জাতীয় পরিচয়পত্র -->
        <div>
            <label for="national_id" class="block text-sm font-medium text-gray-700">জাতীয় পরিচয়পত্র / জন্ম সনদ নম্বর</label>
            <input type="text" id="national_id" name="national_id" wire:model="national_id"
                   autocomplete="off" placeholder="NID বা জন্ম সনদ নম্বর লিখুন"
                   class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('national_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- জন্ম তারিখ -->
        <div>
            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">জন্ম তারিখ</label>
            <input type="date" id="date_of_birth" name="date_of_birth" wire:model="date_of_birth"
                    class="mt-1 block w-full px-4 py-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            @error('date_of_birth') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- সাবমিট -->
        <div>
            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transform hover:scale-105 transition duration-300">
                রেজিস্টার করুন
            </button>
        </div>
    </form>
    <p class="mt-4 text-center text-gray-600">
        Already Have Account <a href="{{ route('login') }}" class="text-blue-600 hover:underline">লগইন করুন</a>
    </p>
</div>
