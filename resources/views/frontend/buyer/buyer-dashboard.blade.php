@extends('frontend.layouts.buyer-layouts.buyer-master')
@section('title', 'Buyer Dashboard')
@section('content')
    <div class="flex justify-end mt-6">
        <a href="{{ url('/') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300 shadow-md">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m4-6v6m5 0a2 2 0 002-2V9a2 2 0 00-.586-1.414l-7-7a2 2 0 00-2.828 0l-7 7A2 2 0 003 9v7a2 2 0 002 2h2z"></path>
            </svg>
                হোম পেজে যান
            </a>
    </div>

    @livewire('buyer.order-status')
    @livewire('cart-page')
    @include('frontend.buyer.components.buy-cart-info')
@endsection