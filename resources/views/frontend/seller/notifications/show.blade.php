@extends('frontend.layouts.seller-layouts.seller-master')
@section('title','Notification Details Page')
@section('content')
    <div class="max-w-xl mx-auto p-4">
        <h1 class="text-xl font-semibold mb-4">অর্ডার বিস্তারিত</h1>

        <div class="border p-4 rounded mb-4">
            <h2 class="text-lg font-semibold">প্রোডাক্ট:</h2>
            <p>নাম: {{ $product['name'] }}</p>
            <p>দাম: {{ $product['price'] }}</p>
            {{-- @dd($product['quantity']); --}}
            <p>পরিমাণ: {{ $product['quantity'] ?? 1 }}</p>
            <div>
                {{ $orderTime }}
            </div>
        </div>
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded shadow-md max-w-xl mx-auto my-6">
            <div class="flex items-center space-x-2">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 8v.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="text-lg font-semibold">অনুগ্রহ করে পণ্যটি এডমিন কে পৌছে দিন</h2>
            </div>
        </div>

    </div>
@endsection
