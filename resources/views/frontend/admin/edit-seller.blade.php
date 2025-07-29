@extends('frontend.layouts.admin-layouts.admin-master')
@section('title', 'Edit Seller Information')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md mt-10">
    <h2 class="text-2xl font-semibold mb-4">Edit Seller</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.seller.update', $seller->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Full Name -->
        <div class="mb-4">
            <label class="block text-gray-700">Full Name</label>
            <input type="text" name="name" value="{{ old('name', $seller->name) }}" class="w-full border px-3 py-2 rounded" required>
            @error('name') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $seller->email) }}" class="w-full border px-3 py-2 rounded" required>
            @error('email') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label class="block text-gray-700">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $seller->phone) }}" class="w-full border px-3 py-2 rounded" required>
            @error('phone') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Store Name -->
        <div class="mb-4">
            <label class="block text-gray-700">Store Name</label>
            <input type="text" name="store_name" value="{{ old('store_name', $seller->store_name) }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Address -->
        <div class="mb-4">
            <label class="block text-gray-700">Address</label>
            <input type="text" name="address" value="{{ old('address', $seller->address) }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- National ID -->
        <div class="mb-4">
            <label class="block text-gray-700">National ID / Birth Certificate</label>
            <input type="text" name="national_id" value="{{ old('national_id', $seller->national_id) }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Status Dropdown -->
        <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded">
                <option value="Approved" {{ old('status', $seller->status) == 'Approved' ? 'selected' : '' }}>Approved</option>
                <option value="Pending" {{ old('status', $seller->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Rejected" {{ old('status', $seller->status) == 'Rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
            @error('status') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Profile Image -->
        <div class="mb-4">
            <label class="block text-gray-700">Profile Image</label>
            <input type="file" name="profile_image" accept="image/*" class="w-full border px-3 py-2 rounded">
            @error('profile_image') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror

            @if ($seller->profile_image)
                <div class="mt-2">
                    <p class="text-sm text-gray-600">Current Image:</p>
                    <img src="{{ asset('storage/' . $seller->profile_image) }}" class="w-20 h-20 rounded object-cover mt-1">
                </div>
            @endif
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
        </div>
    </form>
</div>
@endsection
