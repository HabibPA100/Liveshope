<div class="container mx-auto px-4 py-6 overflow-x-hidden">
    <h2 class="text-2xl md:text-3xl font-bold mb-6" data-aos="fade-down">
        🛒 আপনার কার্ট
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-5 lg:grid-cols-7 gap-6">
        <!-- 🛍️ কার্ট আইটেম লিস্ট -->
        <div class="col-span-1 md:col-span-3 lg:col-span-4 space-y-4">
            @forelse ($cart as $item)
                <div class="flex gap-4 border rounded-lg shadow-md p-4 bg-white" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-full md:w-32">
                        <img 
                            src="{{ asset('storage/' . $item['product_image']) }}" 
                            alt="{{ $item['name'] }}"
                            class="w-full h-32 object-cover rounded"
                        />
                    </div>

                    <div class=" min-w-0 space-y-1">
                        @php
                            $title = $item['name'];
                            $length = Str::length($title);
                            if ($length > 25) {
                                $displayTitle = Str::substr($title, 0, 25); // কেটে ২৫ অক্ষর নেওয়া
                            } elseif ($length < 25) {
                                $displayTitle = $title . str_repeat('🔥', 25 - $length); // যতটুকু ঘাটতি, ততগুলো . যোগ
                            } else {
                                $displayTitle = $title; // ঠিক ২৫ হলে, যেভাবে আছে সেভাবেই
                            }
                        @endphp

                        <h3 class="font-bold text-lg mt-3 text-gray-800 hover:text-blue-600 transition">
                            {{ $displayTitle }}
                        </h3>
                        <p class="text-gray-600 text-sm md:text-base">মূল্য: {{ $item['price'] }}৳</p>
                        <p class="text-gray-600 text-sm md:text-base">পরিমাণ: {{ $item['quantity'] }}</p>
                        <p class="text-green-600 font-semibold">মোট: {{ $item['price'] * $item['quantity'] }}৳</p>

                        <button wire:click="remove({{ $item['id'] }})" class="mt-4 bg-gray-600 hover:bg-red-700 text-white px-4 py-2 rounded w-fit">
                            ❌
                        </button>
                    </div>
                    <div class="flex items-center gap-2 mt-2 flex-wrap">
                        <button wire:click="decrement({{ $item['id'] }})" class="px-3 py-1 bg-gray-300 hover:bg-gray-400 text-black rounded">-</button>
                        <span class="px-4 py-1 bg-white border rounded">{{ $item['quantity'] }}</span>
                        <button wire:click="increment({{ $item['id'] }})" class="px-3 py-1 bg-gray-300 hover:bg-gray-400 text-black rounded">+</button>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 text-lg" data-aos="zoom-in">
                    😕 আপনার কার্ট খালি!
                </div>
            @endforelse
        </div>

        <!-- 📦 অর্ডার সামারি -->
        @if($cart)
        <div class="col-span-1 md:col-span-2 lg:col-span-3 space-y-6" data-aos="fade-left" data-aos-delay="200">
            <h1>অর্ডার করুন - ক্যাশ অন ডেলিভারিতে</h1>

            <form wire:submit.prevent="placeOrder" class="space-y-6">
                <!-- অর্ডার সারাংশ -->
                <div class="border rounded bg-gray-50 p-4 space-y-3 shadow-sm">
                    <div class="flex justify-between text-lg font-medium">
                        <span>মোট পরিমাণ:</span>
                        <span>৳ {{ $this->subtotal }}</span>
                    </div>
                    <div class="flex justify-between text-lg font-medium">
                        <span>ডেলিভারি চার্জ:</span>
                        <span>৳ {{ $this->deliveryCharge }}</span>
                    </div>
                    <hr>
                    <div class="flex justify-between text-xl font-bold text-red-700">
                        <span>সর্ব মোট:</span>
                        <span>৳ {{ $this->subtotal + $this->deliveryCharge }}</span>
                    </div>
                </div>

                <!-- 🏙️ ডেলিভারি এরিয়া নির্বাচন -->
                <div class="space-y-4">
                    <h2 class="text-xl font-semibold">ডেলিভারি এরিয়া:</h2>
                    @foreach($deliveryOptions as $key => $option)
                        <label class="flex items-start gap-3 p-4 border rounded cursor-pointer hover:bg-gray-100 w-full">
                            <input type="radio" wire:model="selectedDeliveryArea" wire:change="$refresh" value="{{ $key }}" class="mt-1">
                            <div class="min-w-0">
                                <span class="font-medium">{{ $option['label'] }}</span>
                                <span class="text-sm text-gray-500">৳ {{ $option['charge'] }}</span>
                            </div>
                        </label>
                    @endforeach

                </div>

                <!-- 📝 ইউজার ইনফর্মেশন -->
                <div class="space-y-4">

                    <!-- ঠিকানা -->
                    <div class="flex items-start border rounded px-4 py-3 bg-white shadow-sm">
                        <svg class="w-5 h-5 text-gray-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/>
                            <circle cx="12" cy="9" r="2.5"/>
                        </svg>
                        <textarea wire:model="delivery_address" placeholder="ডেলিভারি ঠিকানা" rows="3" class="w-full focus:outline-none"></textarea>
                    </div>

                    <!-- অর্ডার নোট -->
                    <div class="flex items-start border rounded px-4 py-3 bg-white shadow-sm">
                        <svg class="w-5 h-5 text-gray-500 mr-3 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4 4h16v2H4zm0 4h10v2H4zm0 4h7v2H4zm0 4h4v2H4z"/>
                        </svg>
                        <textarea wire:model="order_note" placeholder="অর্ডার সম্পর্কিত কোনো নোট (ঐচ্ছিক)" rows="2" class="w-full focus:outline-none"></textarea>
                    </div>
                </div>
                
                <p>ঢাকা ব্যতিত অন্য সকল স্থানের ক্ষেত্রে আপনার নিকটস্থ কুরিয়ার থেকে পার্সেল টি গ্রহণ করতে হবে ! </p>
                <!-- ✅ সাবমিট বাটন -->
                <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-green-700 hover:from-green-600 hover:to-green-800 text-white py-3 px-6 rounded-lg text-lg font-semibold shadow-md transition duration-300">
                    ✅ অর্ডার কনফার্ম করুন
                </button>
                
                <!-- ⏳ সাবমিশন চলাকালীন ওয়েটিং বার্তা -->
                <div 
                    wire:loading 
                    wire:target="placeOrder" 
                    class="flex items-center justify-center gap-2 text-green-700 font-medium py-3"
                >
                    <!-- Spinner -->
                    <span class="flex items-center">
                        <svg class="w-5 h-5 animate-spin text-green-600 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z">
                            </path>
                        </svg>
                        <span> অর্ডারটি সাবমিট হচ্ছে, অনুগ্রহ করে অপেক্ষা করুন...</span>
                    </span>
                </div>

            </form>

        </div>
        @endif
    </div>
</div>
