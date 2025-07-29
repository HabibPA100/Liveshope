@extends('frontend.layouts.admin-layouts.admin-master')
@section('title', 'Notification Details Page')

@section('content')
    <div class="max-w-4xl mx-auto my-4 bg-white shadow p-6 rounded-md">
        <h2 class="text-xl font-semibold mb-4">নোটিফিকেশন ডিটেইলস</h2>
        {{-- @php dd($data); @endphp --}}
        <div class="mb-4">
            <p class="mb-1"><strong>বার্তা:</strong> {{ $data['message'] }}</p>
            <p><strong>অর্ডার আইডি:</strong> #{{ $data['unique_order_id'] ?? 'N/A' }}</p>
            <p class="mb-1"><strong>মোট অর্ডার:</strong> {{ $data['total'] }} টাকা</p>
            <p class="text-sm text-gray-500">পাওয়ার সময়: {{ $notification->created_at->diffForHumans() }}</p>
        </div>
        {{-- Buyer info  --}}
        @if(isset($data['buyer']))
            <div class="mb-6 bg-gray-50 p-4 rounded-md border">
                <h4 class="text-md font-semibold mb-2">ক্রেতার তথ্য</h4>
                <ul class="text-sm text-gray-700 space-y-1">
                    <li><strong>নাম:</strong> {{ $data['buyer']['name'] ?? 'N/A' }}</li>
                    <li><strong>ইমেইল:</strong> {{ $data['buyer']['email'] ?? 'N/A' }}</li>
                    <li><strong>ফোন:</strong> {{ $data['buyer']['phone'] ?? 'N/A' }}</li>
                    <li><strong>ডেলিভারি স্থান:</strong> {{ $data['delivery_address'] ?? 'N/A' }}</li>
                    <li><strong>ডেলিভারি এরিয়া:</strong> {{ $data['delivery_area'] ?? 'N/A' }}</li>
                </ul>
            </div>
        @endif
        @if($cartItems->count())
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-3 border-b pb-1">অর্ডারকৃত পণ্য ও সেলার তথ্য</h3>

                <div class="space-y-4">
                    @foreach($cartItems as $item)
                        @php
                            $seller = $sellers[$item['seller_id']] ?? null;
                        @endphp
                        <div class="p-4 border rounded-md bg-gray-50">
                            <p><strong>পণ্যের নাম:</strong> {{ $item['name'] }}</p>
                            <p><strong>পরিমাণ:</strong> {{ $item['quantity'] }}</p>

                            <div class="mt-2">
                                <p class="font-medium text-gray-700">সেলার তথ্য:</p>
                                <ul class="text-sm text-gray-600 ml-4 list-disc">
                                    <li><strong>নাম:</strong> {{ $seller->name ?? 'N/A' }}</li>
                                    <li><strong>মোবাইল:</strong> {{ $seller->phone ?? 'N/A' }}</li>
                                    <li><strong>ঠিকানা:</strong> {{ $seller->address ?? 'N/A' }}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- QR Code --}}
                @if($qrCodePath)
                    <div class="mt-8 flex justify-center">
                        <img src="{{ asset('storage/' . $qrCodePath) }}" alt="QR Code" class="w-40 h-40 object-contain">
                    </div>
                @endif
            </div>
            <a href="{{ route('notification.download.pdf', $notification->id) }}" 
                class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                📥 PDF ডাউনলোড করুন
            </a>

        @else
            <p class="text-gray-500 mt-6">এই নোটিফিকেশনে কোনো পণ্য তথ্য নেই।</p>
        @endif
    </div>
@endsection
