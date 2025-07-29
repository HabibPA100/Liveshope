@extends('frontend.layouts.master')

@section('head')
    {{-- SEO / Social Meta --}}
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $card->title }}" />
    <meta property="og:description" content="{{ Str::limit(strip_tags($card->description), 50) }}" />
    <meta property="og:image" content="{{ asset('storage/' . $card->slash_image) }}" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $card->title }}" />
    <meta name="twitter:description" content="{{ Str::limit(strip_tags($card->description), 50) }}" />
    <meta name="twitter:image" content="{{ asset('storage/' . $card->slash_image) }}" />
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        <!-- 🖼️ Product Image Section --> 
        <div class="md:col-span-5 space-y-4">
            <div class="relative group w-full max-w-xl mx-auto">
                <img 
                    id="mainImage"
                    src="{{ asset('storage/' . $card->slash_image) }}" 
                    alt="{{ $card->title }}" 
                    class="w-full rounded-lg shadow-lg object-contain max-h-[400px] cursor-zoom-in"
                >

                <div 
                    id="zoomResult" 
                    class="hidden absolute top-0 left-full ml-4 w-[430px] h-[400px] border rounded shadow-lg bg-no-repeat z-50"
                ></div>
            </div>
            
            <!-- 🧷 Related Image Thumbnails -->
            <div class="flex gap-3 overflow-x-auto scrollbar-hide">
                @foreach ($related as $rel)
                    <a href="{{ route('cart.details', $rel->id) }}" class="min-w-[5rem]">
                        <img 
                            src="{{ asset('storage/' . $rel->product_image) }}" 
                            alt="{{ $rel->title }}" 
                            class="w-20 h-20 object-cover rounded-lg hover:ring-2 ring-blue-500 transition"
                        >
                    </a>
                @endforeach
            </div>
        </div>

        <!-- 📋 Product Details -->
        <div class="md:col-span-4 space-y-4">
            <h2 class="text-2xl font-bold text-gray-900">{{ $card->title }}</h2>

            <div class="text-gray-700 prose max-w-none">
                {!! $card->description !!}
            </div>

            <div class="flex items-center gap-2 text-sm mt-2">
                <span class="font-semibold">স্ট্যাটাস:</span>
                @if($card->status === 'in stock')
                    <span class="text-green-600">✅ {{ $card->status }}</span>
                @else
                    <span class="text-red-600">❌ {{ $card->status }}</span>
                @endif
            </div>

            <!-- 💰 Price Section -->
            <div class="text-3xl font-bold text-blue-600">
                ৳{{ number_format($card->offer_price, 2) }}
                <span class="text-lg text-gray-500 line-through ml-2">
                    ৳{{ number_format($card->real_price, 2) }}
                </span>
            </div>

            <!-- 🛒 Cart Button -->
            <div class="mt-6">
                <livewire:add-to-cart 
                    :productId="$card->id" 
                    :key="$card->id" 
                    buttonClass="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg text-lg font-semibold shadow"
                />
            </div>

            <!-- 🔗 Social Share -->
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-2">📤 শেয়ার করুন:</h3>
                <div class="flex gap-4 text-xl">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="text-blue-600 hover:text-blue-800"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank" class="text-green-500 hover:text-green-700"><i class="fab fa-whatsapp"></i></a>
                    <a href="fb-messenger://share?link={{ urlencode(url()->current()) }}" target="_blank" class="text-blue-500 hover:text-blue-700"><i class="fab fa-facebook-messenger"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank" class="text-gray-700 hover:text-black"><i class="fab fa-x-twitter"></i></a>
                </div>
            </div>
        </div>

        <!-- 🎯 Related Items -->
        <div class="md:col-span-3 space-y-4">
            <h2 class="text-lg font-semibold text-gray-800">Related Products</h2>
            @foreach ($related as $item)
                <a href="{{ route('cart.details', $item->id) }}" class="flex gap-3 items-center bg-white shadow-sm rounded-lg p-2 hover:bg-gray-50 transition">
                    <img src="{{ asset('storage/' . $item->product_image) }}" alt="{{ $item->title }}" class="w-16 h-16 object-cover rounded">
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-gray-900">
                            {{ Str::limit($item->title, 30) }}
                        </h3>
                        <p class="text-green-600 text-sm font-bold mt-1">৳{{ number_format($item->offer_price, 2) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- Optional Slider --}}
@include('frontend.layouts.components.right-slider')

@push('scripts')
    <script src="{{ asset('frontend/js/image-preview.js') }}"></script>
    <script src="{{ asset('frontend/js/right-to-left-slider.js') }}"></script>
@endpush
@endsection
