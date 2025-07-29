@extends('frontend.layouts.master')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1>All Products</h1>

    <!-- Responsive Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        
        @foreach ($allProduct as $product)
            <div class="bg-white shadow-md rounded overflow-hidden transform transition hover:-translate-y-1 hover:shadow-lg" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                
                <!-- Product Image -->
                <div class="p-3">
                    <img src="{{ asset('storage/' . $product->product_image) }}" 
                         class="w-full h-40 object-cover rounded hover:scale-105 transition duration-300" 
                         alt="{{ $product->title }}">
                </div>

                <!-- Product Details -->
                <div class="px-4 pb-4">
                    <!-- Status -->
                    @if($product->status == 'in stock')
                        <p class="text-green-700 text-sm">✅ {{ $product->status }}</p>
                    @else
                        <p class="text-red-700 text-sm">❌ {{ $product->status }}</p>
                    @endif

                    <!-- Title -->
                    @php
                        $title = $product->title;
                        $length = Str::length($title);
                        $displayTitle = $length > 25 
                            ? Str::substr($title, 0, 25) 
                            : $title . str_repeat('.', 25 - $length);
                    @endphp
                    <h3 class="font-semibold text-md mt-2 text-gray-800 hover:text-blue-600 transition">
                        {{ $displayTitle }}
                    </h3>

                    <!-- Price -->
                    <p class="text-green-700 font-bold text-lg mt-1">
                        ৳{{ number_format($product->offer_price, 2) }} 
                        <span class="text-gray-500 text-sm">
                            <del>৳{{ number_format($product->real_price, 2) }}</del>
                        </span>
                    </p>

                    <!-- Buttons -->
                    <div class="flex justify-between items-center mt-4">
                        <a href="{{ route('cart.details', $product->id) }}" 
                           class="text-xs bg-gray-200 text-gray-800 px-3 py-1 rounded hover:bg-gray-300 transition">
                            View
                        </a>
                        <livewire:add-to-cart 
                            :productId="$product->id" 
                            :key="$product->id" 
                            buttonClass="text-xs bg-pink-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition shadow hover:shadow-lg"
                        />
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
