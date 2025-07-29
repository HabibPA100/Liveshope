@extends('frontend.layouts.buyer-layouts.buyer-master')
@section('title', 'Notification Details Page')
@section('content')
    <div class="max-w-3xl mx-auto mt-6 p-6 bg-white shadow rounded">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">নোটিফিকেশন ডিটেইলস</h2>

        <p class="text-gray-700 mb-2">
            <strong>বার্তা:</strong> {{ $notification->data['message'] ?? 'বার্তা পাওয়া যায়নি' }}
        </p>

        <p class="text-sm text-gray-500">
            <strong>সময়:</strong> {{ $notification->created_at->timezone('Asia/Dhaka')->format('d M, Y h:i A') }}
        </p>

        <a href="{{ route('buyer.dashboard') }}" class="text-blue-500 text-sm mt-4 inline-block">← ড্যাশবোর্ডে ফিরে যান</a>
    </div>
@endsection
