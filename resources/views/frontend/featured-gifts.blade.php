@extends('frontend.layouts.master') 
@section('content')
<div>
@if ($gifts->isNotEmpty())
    <section class="bg-gray-100 py-3 px-4">
        <div class="max-w-7xl mx-auto">
            <h3>সকল প্রিয় গিফট প্যাকস</h3>

            <div class="flex flex-wrap -mx-2">
                @foreach($gifts as $gift)
                    <div class="w-full sm:w-1/2 lg:w-1/5 px-2 mb-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="left-bottom-border">
                            <div class="left-linear transition-all duration-300 transform p-2">
                                <img src="{{ asset('storage/' . $gift->product_image) }}" class="w-full h-40 object-cover rounded hover:-translate-y-2 hover:scale-105 hover:opacity-90 transition duration-300" alt="{{ $gift->title }}">
                                @if($gift->status == 'in stock')
                                    <p class="text-green-700">✅{{ $gift->status }}</p>
                                @else
                                    <p class="text-red-700">❌{{ $gift->status }}</p>
                                @endif
                                @php
                                    $title = $gift->title;
                                    $length = Str::length($title);
                                    if ($length > 25) {
                                        $displayTitle = Str::substr($title, 0, 25); // কেটে ২৫ অক্ষর নেওয়া
                                    } elseif ($length < 25) {
                                        $displayTitle = $title . str_repeat('.', 25 - $length); // যতটুকু ঘাটতি, ততগুলো . যোগ
                                    } else {
                                        $displayTitle = $title; // ঠিক ২৫ হলে, যেভাবে আছে সেভাবেই
                                    }
                                @endphp

                                <h3 class="font-bold text-lg mt-3 text-gray-800 hover:text-blue-600 transition">
                                    {{ $displayTitle }}
                                </h3>
                                <div class="text-xl font-bold text-blue-600">
                                    <p class="text-green-700"> ৳{{ number_format($gift->offer_price, 2) }} 
                                        <span class="text-gray-500"> 
                                            <del> ৳{{ number_format($gift->real_price, 2) }} </del>
                                        </span>
                                    </p> 
                                </div>
                                <div class="flex justify-between items-center pt-4">
                                    <a href="{{ route('cart.details', $gift->id) }}" class="text-sm bg-gray-300 text-gray-900 px-3 p-2 rounded hover:bg-green-300 transition">View</a>
                                    <livewire:add-to-cart 
                                            :productId="$gift->id" 
                                            :key="$gift->id" 
                                            buttonClass="text-sm bg-pink-500 text-white p-2 rounded hover:bg-orange-600 transition shadow hover:shadow-lg"
                                        />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@else
    <p class="text-center py-10 text-gray-600">কোনো গিফট প্যাক পাওয়া যায়নি।</p>
@endif
</div>
@endsection
