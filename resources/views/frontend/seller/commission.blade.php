@extends('frontend.layouts.seller-layouts.seller-master')

@section('title', 'Commission Counter')

@section('content')
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('success'))
        <div class="max-w-xl mx-auto mt-4">
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 border border-green-300" role="alert">
                <svg class="w-5 h-5 mr-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4h2v2h-2v-2zm0-8h2v6h-2V6z"/>
                </svg>
                <span class="font-medium">সফল!</span> {{ session('success') }}
            </div>
        </div>
    @endif
    
<div class="max-w-4xl mx-auto mt-10 p-6 bg-white shadow-md rounded-xl">
    <h1 class="text-sm lg:text-2xl font-bold text-white mb-6">🧮 Commission & Seller Offers</h1>

    <!-- Commission Guidelines -->
    <div class="mb-10">
        <h2 class="text-2xl font-semibold text-gray-700 mb-3">📌 Commission System</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li>সাধারণ প্রোডাক্ট: <span class="font-bold text-green-600">৮% কমিশন</span></li>
            <li>ইলেকট্রনিক্স: <span class="font-bold text-green-600">৫%</span></li>
            <li>হ্যান্ডমেড বা লোকাল পণ্য: <span class="font-bold text-green-600">১০%</span></li>
            <li>মাসে ৫০,০০০৳+ বিক্রি করলে: কমিশন <span class="text-blue-600 font-bold">কমে গিয়ে হবে ৪%</span></li>
        </ul>
    </div>

    <!--🔥 Limited Time Offer -->
    <div class="bg-gradient-to-r from-yellow-200 to-pink-100 border-l-4 border-yellow-500 p-4 mb-10 rounded-lg">
        <p class="text-md text-gray-800 font-semibold">🔥 <span class="text-red-600">লিমিটেড টাইম অফার:</span> 
        যদি আপনি কমিশন পদ্ধতি পছন্দ না করেন, তাহলে আপনি মাত্র <span class="font-bold text-green-700">৳৯৯৯</span> এককালীন সাবস্ক্রিপশন ফি দিয়ে 
        <span class="font-bold text-blue-600">পুরো ১ বছর কমিশন ফ্রি</span> সেল করতে পারবেন! 🥳  
        <br>
        </p>
    </div>

    <!-- Commission Calculator -->
    <div class="mb-12">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">🔢 কমিশন ক্যালকুলেটর</h2>

        <div x-data="{
                price: 0,
                commissionRate: 8,
                get commissionAmount() {
                    return (this.price * this.commissionRate / 100).toFixed(2);
                },
                get sellerEarnings() {
                    return (this.price - this.commissionAmount).toFixed(2);
                }
            }" class="space-y-4" x-init>
            <div>
                <label class="block text-sm font-medium text-gray-600">পণ্যের দাম (৳)</label>
                <input x-model.number="price" type="number" min="0" class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600">কমিশন রেট (%)</label>
                <select x-model.number="commissionRate" class="mt-1 w-full rounded-md border border-gray-300 p-2 focus:ring focus:ring-blue-200">
                    <option value="5">৫% (ইলেকট্রনিক্স)</option>
                    <option value="8" selected>৮% (সাধারণ পণ্য)</option>
                    <option value="10">১০% (হ্যান্ডমেড)</option>
                </select>
            </div>

            <div class="bg-gray-100 p-4 rounded-md">
                <p class="text-gray-700">📉 কাটা হবে: <span class="font-bold text-red-600">৳<span x-text="commissionAmount"></span></span></p>
                <p class="text-gray-700">💰 আপনি পাবেন: <span class="font-bold text-green-600">৳<span x-text="sellerEarnings"></span></span></p>
            </div>
        </div>
    </div>

    <!-- Why Join Section -->
    <div class="mb-10">
        <h2 class="text-xl font-semibold text-gray-700 mb-3">🤝 কেন আমাদের প্লাটফর্মে সেল করবেন?</h2>
        <ul class="list-disc list-inside text-gray-700 space-y-1">
            <li>🔥 প্রথম ৩ মাস নতুন সেলারদের জন্য স্পেশাল কমিশন ডিসকাউন্ট!</li>
            <li>🎯 প্রোডাক্ট গুলোর SEO আমরা করে দেই</li>
            <li>💸 প্রতি সপ্তাহে বিক্রির পেমেন্ট ক্যাশআউট</li>
            <li>📊 সেলারদের জন্য বিশেষ বিক্রয় রিপোর্ট + গ্রোথ এনালাইটিক্স</li>
        </ul>
    </div>
</div>

<div class="max-w-6xl mx-auto px-4 py-12 mt-5" x-data="{ open: false, selectedId: null, price: 0 }">

    <h2 class="text-3xl font-bold text-center text-gray-800 mb-10">🔥 Commission-Free Subscription Plans</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        @foreach ($plans as $plan)
            <div class="relative bg-white shadow-lg rounded-xl border {{ $plan->highlight ? 'border-blue-500' : 'border-gray-200' }} p-6 flex flex-col justify-between hover:shadow-xl transition-all">

                @if($plan->highlight)
                    <span class="absolute -top-3 right-4 bg-blue-600 text-white text-xs px-3 py-1 rounded-full shadow-md">⭐️ Most Popular</span>
                @endif

                <div>
                    <div class="flex justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $plan->duration }}</h3>
                            <p class="text-gray-500 text-sm mb-4">{{ $plan->tag ?? 'N/A' }}</p>
                        </div>
                        <div>
                            @if ($commission && $commission->subscription_id == $plan->id)
                                <button class="border-lime-400 rounded-lg p-1 bg-green-200">Active</button>
                            @else
                                <button class="border-red-500 rounded-lg p-1 bg-red-200">Not Active</button>
                            @endif
                        </div>
                    </div>

                    <div class="text-3xl font-bold text-blue-600 mb-4">৳{{ $plan->price ?? 'N/A' }}</div>

                    <ul class="space-y-2 text-gray-700 text-sm">
                        <li>✅ {{ $plan->duration }} কমিশন ফ্রি সেল</li>
                        <li>✅ সর্বোচ্চ লাভ আপনাকেই</li>
                        <li>✅ ২৪/৭ সেলার সাপোর্ট</li>
                        <li>✅ Weekly Report + Insights</li>
                    </ul>
                </div>

                <div class="mt-6">
                    <button 
                        @click="open = true; selectedId = '{{ $plan->id }}'; price = '{{ $plan->price }}';" 
                        type="button" 
                        class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg transition">
                        সাবস্ক্রাইব করুন
                    </button>
                </div>
            </div>
        @endforeach

    </div>

    <p class="text-center text-gray-500 text-sm mt-8">📌 আপনি যেকোনো সময় আপগ্রেড করতে পারেন। টাকা ফেরতের নিশ্চয়তা নেই।</p>

    <!-- Subscription Modal -->
    <div 
        x-show="open" 
        class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
        x-cloak
    >
        <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">
            <!-- Close Button -->
            <button @click="open = false" class="absolute top-2 right-2 text-gray-600 hover:text-red-600">&times;</button>

            <h2 class="text-xl font-semibold text-gray-800 mb-4">📥 সাবস্ক্রিপশন নিশ্চিত করুন</h2>
             <div class="bg-gray-100 p-3 rounded-md text-center">
                <p class="text-lg text-gray-700">এই নাম্বারে পে করুন </p>
                <p class="font-bold text-red-600 text-xl">01885457117</p>
                <p class="text-yellow-500">[Bkash/Nagad send money]</p>
            </div>
            <form action="{{ route('subscription.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="subscription_id" :value="selectedId">
                <input type="hidden" name="amount" :value="price">

                <div>
                    <label class="block text-sm font-medium text-gray-700">পেমেন্ট নাম্বার (Bkash/Nagad)</label>
                    <input type="text" name="payment_number" required class="mt-1 w-full border p-2 rounded-md border-gray-300 focus:ring focus:ring-blue-200">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">ট্রানজেকশন আইডি</label>
                    <input type="text" name="trx_id" required class="mt-1 w-full border p-2 rounded-md border-gray-300 focus:ring focus:ring-blue-200">
                </div>

                @error('trx_id')
                    <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror

                <div class="bg-gray-100 p-3 rounded-md">
                    <p class="text-sm text-gray-700">আপনি <span class="font-bold text-green-600">৳<span x-text="price"></span></span> পে করেছেন।</p>
                </div>

                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg transition">রিকুয়েস্ট সাবমিট করুন</button>
            </form>
        </div>
    </div>
</div>
@endsection
