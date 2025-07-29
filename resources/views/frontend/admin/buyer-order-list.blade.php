@extends('frontend.layouts.admin-layouts.admin-master')
@section('title', 'Buyer Order List')

@section('content')
    <div class="max-w-6xl mx-auto py-6">
        <h2 class="text-2xl font-bold mb-6 text-center">বায়ারের অর্ডার ফর্ম তালিকা</h2>

        @forelse($orders as $order)
            <div class="bg-white shadow rounded p-6 mb-6 border">
                <h3 class="text-lg font-semibold mb-2">অর্ডার আইডি: {{ $order->unique_order_id }}</h3>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p><strong>নাম:</strong> {{ $order->name }}</p>
                        <p><strong>ফোন:</strong> {{ $order->phone }}</p>
                        <p><strong>ঠিকানা:</strong> {{ $order->delivery_address }}</p>
                        <p><strong>এরিয়া:</strong> {{ $order->delivery_area }}</p>
                    </div>
                    <div>
                        <p><strong>মোট:</strong> {{ $order->total }} টাকা</p>
                        <p><strong>নোট:</strong> {{ $order->order_note ?? 'N/A' }}</p>
                        <p><strong>তারিখ:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <h4 class="font-semibold">পণ্যের তালিকা:</h4>
                    <ul class="list-disc ml-6">
                        @foreach(is_string($order->cart_items) ? json_decode($order->cart_items, true) : $order->cart_items as $item)
                            <li>{{ $item['name'] }} - Qty: {{ $item['quantity'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                <div class="flex items-center justify-center">
                    <img src="{{ asset('storage/'. $order->qr_code_path) }}" alt="QR Code">
                </div>
                <div class="mt-5">
                    <a href="{{ route('admin.order.download', $order->id) }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded">
                        📥 Download PDF
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">🙁 কোনো অর্ডার পাওয়া যায়নি।</p>
        @endforelse
    </div>
@endsection
