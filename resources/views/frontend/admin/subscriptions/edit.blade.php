@extends('frontend.layouts.admin-layouts.admin-master')

@section('content')
    <div class="max-w-xl mx-auto bg-white shadow p-6 rounded mt-6">
        <h2 class="text-xl font-bold mb-4">Edit Subscription</h2>

        <form action="{{ route('admin.subscriptions.update', $subscription->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <!-- Status -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Status</label>
                <select name="status" class="w-full border px-3 py-2 rounded">
                    <option value="pending" {{ $subscription->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ $subscription->status == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ $subscription->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <!-- Start Date -->
            <div class="mb-4">
                <label class="block font-medium mb-1">Start Date</label>
                <input type="date" name="start_date" value="{{ $subscription->start_date }}" class="w-full border px-3 py-2 rounded">
            </div>

            <!-- End Date -->
            <div class="mb-4">
                <label class="block font-medium mb-1">End Date</label>
                <input type="date" name="end_date" value="{{ $subscription->end_date }}" class="w-full border px-3 py-2 rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </form>
    </div>
@endsection