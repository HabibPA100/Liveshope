@extends('frontend.layouts.admin-layouts.admin-master')

@section('content')
<div class="p-4 container max-w-[1200px] mx-auto">
    <h2 class="text-2xl font-bold mb-4">সকল সাবস্ক্রিপশন</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    {{-- Colorful Table Wrapper --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border text-sm text-left">
            <thead>
                <tr class="bg-gradient-to-r from-purple-300 to-indigo-300 text-gray-800">
                    <th class="p-2 whitespace-nowrap">User</th>
                    <th class="p-2 whitespace-nowrap">Plan</th>
                    <th class="p-2 whitespace-nowrap">Start at</th>
                    <th class="p-2 whitespace-nowrap">End at</th>
                    <th class="p-2 whitespace-nowrap">Amount</th>
                    <th class="p-2 whitespace-nowrap">TRX ID</th>
                    <th class="p-2 whitespace-nowrap">Status</th>
                    <th class="p-2 whitespace-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subscriptions as $index => $subscription)
                    @php
                        $rowBg = $index % 2 === 0 
                            ? 'bg-gradient-to-r from-pink-100 via-yellow-100 to-green-100' 
                            : 'bg-gradient-to-r from-green-100 via-blue-100 to-purple-100';
                    @endphp
                    <tr class="border-b-2 shadow hover:scale-[1.01] transform transition duration-300 {{ $rowBg }}">
                        <td class="p-2 whitespace-nowrap font-semibold text-purple-800">{{ $subscription->seller->name ?? 'N/A' }}</td>
                        <td class="p-2 whitespace-nowrap text-indigo-700">{{ $subscription->plan->duration ?? 'N/A' }}</td>
                        <td class="p-2 whitespace-nowrap">{{ $subscription->start_date ?? 'N/A' }}</td>
                        <td class="p-2 whitespace-nowrap">{{ $subscription->end_date ?? 'N/A' }}</td>
                        <td class="p-2 whitespace-nowrap font-bold text-green-700">{{ $subscription->amount }}</td>
                        <td class="p-2 whitespace-nowrap text-sm">{{ $subscription->trx_id }}</td>
                        <td class="p-2 whitespace-nowrap">
                            <span class="px-2 py-1 rounded font-medium
                                {{ 
                                    $subscription->status == 'approved' ? 'bg-green-300 text-green-900' :
                                    ($subscription->status == 'rejected' ? 'bg-red-300 text-red-900' : 'bg-yellow-300 text-yellow-900')
                                }}">
                                {{ ucfirst($subscription->status) }}
                            </span>
                        </td>
                        <td class="p-2 whitespace-nowrap">
                            <a 
                                href="{{ route('admin.subscriptions.edit', $subscription->id) }}" 
                                class="text-blue-600 underline hover:text-blue-900 transition"
                            >
                                Edit
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
