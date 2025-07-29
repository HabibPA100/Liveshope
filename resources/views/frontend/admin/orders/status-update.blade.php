@extends('frontend.layouts.admin-layouts.admin-master')
@section('title', 'Update Order Status')

@section('content')
    <div class="max-w-xl mx-auto my-4 bg-white p-6 shadow rounded">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-2">
                {{ session('success') }}
            </div>
        @endif
                <h2 class="text-lg font-bold mb-4">অর্ডার স্ট্যাটাস আপডেট করুন (#{{ $order->unique_order_id }})</h2>

        <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}">
            @csrf
            @method('PUT')

            <label for="status" class="block mb-1 font-medium">স্ট্যাটাস</label>
            <select name="status" id="status" class="w-full border rounded p-2 mb-4">
                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="on_the_way" {{ $order->status === 'on_the_way' ? 'selected' : '' }}>On The Way</option>
                <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">আপডেট করুন</button>
        </form>
    </div>
@endsection
