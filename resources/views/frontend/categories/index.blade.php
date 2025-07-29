@extends('frontend.layouts.master')

@php
    // category থেকে নাম নিয়ে টাইটেল ও হেডিং এ দেখানো
    $categoryName = $category->name;

    // Breadcrumb path বানানো (parent → child → sub)
    $slugs = [];
    $current = $category;

    while ($current) {
        $slugs[] = $current;
        $current = $current->parent;
    }

    // reverse করে উপরের দিক থেকে সাজানো
    $breadcrumbs = array_reverse($slugs);
@endphp

@section('title')
    Live Shope - {{ $categoryName }}
@endsection

@section('content')
    <section class="bg-gray-100 py-6 px-4">
        <div class="max-w-7xl mx-auto">

            {{-- 🔗 Breadcrumb Navigation --}}
            <nav class="text-sm text-gray-600 mb-4">
                <a href="{{ url('/') }}" class="text-blue-600 hover:underline">হোম</a> &raquo;
                @foreach($breadcrumbs as $crumb)
                    @if (!$loop->last)
                        <a href="{{ route('products.by-category', implode('/', collect($breadcrumbs)->take($loop->index + 1)->pluck('slug')->toArray())) }}"
                           class="text-blue-600 hover:underline">{{ $crumb->name }}</a> &raquo;
                    @else
                        <span class="text-gray-800 font-semibold">{{ $crumb->name }}</span>
                    @endif
                @endforeach
            </nav>

            {{-- 🧾 Category Title --}}
            <h2 class="text-xl font-bold mb-6 text-gray-800">{{ $categoryName }} পণ্য সমূহ</h2>

            {{-- 🛍️ Products --}}
            <div class="flex flex-wrap -mx-2">
                @if($products->isNotEmpty())
                    @foreach($products as $cart)
                        <div class="w-full sm:w-1/2 lg:w-1/5 px-2 mb-6">
                            <div class="bg-white p-3 rounded shadow hover:shadow-md transition">
                                <img src="{{ asset('storage/' . $cart->product_image) }}" class="w-full h-40 object-cover rounded" alt="{{ $cart->title }}">

                                {{-- স্টক --}}
                                <p class="{{ $cart->status == 'in stock' ? 'text-green-700' : 'text-red-700' }}">
                                    {{ $cart->status == 'in stock' ? '✅' : '❌' }} {{ $cart->status }}
                                </p>

                                {{-- টাইটেল --}}
                                @php
                                    $title = $cart->title;
                                    $length = Str::length($title);
                                    $displayTitle = $length > 25 ? Str::substr($title, 0, 25) : $title . str_repeat('.', 25 - $length);
                                @endphp
                                <h3 class="font-bold text-lg mt-3 text-gray-800">{{ $displayTitle }}</h3>

                                {{-- দাম --}}
                                <p class="text-green-700 text-lg font-bold">
                                    ৳{{ number_format($cart->offer_price, 2) }}
                                    <span class="text-gray-500 text-sm ml-1">
                                        <del>৳{{ number_format($cart->real_price, 2) }}</del>
                                    </span>
                                </p>

                                {{-- বাটন --}}
                                <div class="mt-4 flex justify-between items-center">
                                    <a href="{{ route('cart.details', $cart->id) }}" class="text-sm bg-gray-200 px-3 py-1 rounded hover:bg-gray-300">View</a>

                                    <livewire:add-to-cart 
                                        :productId="$cart->id" 
                                        :key="$cart->id" 
                                        buttonClass="text-sm bg-pink-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition"
                                    />
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-600">এই ক্যাটেগরিতে কোন পণ্য পাওয়া যায়নি।</p>
                @endif
            </div>

            {{-- পেজিনেশন --}}
            <div class="mt-6">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>

        </div>
    </section>
@endsection
