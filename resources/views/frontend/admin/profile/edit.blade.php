@extends('frontend.layouts.admin-layouts.admin-master')
@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow-md mt-10">
    <h2 class="text-2xl font-semibold mb-4">Edit Admin Profile</h2>

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-700">Name</label>
            <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label class="block text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- NID -->
        <div class="mb-4">
            <label class="block text-gray-700">NID</label>
            <input type="text" name="nid" value="{{ old('nid', $admin->nid) }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Date of Birth -->
        <div class="mb-4">
            <label class="block text-gray-700">Date of Birth</label>
            <input type="date" name="dob" value="{{ old('dob', $admin->dob) }}" class="w-full border px-3 py-2 rounded">
        </div>

        <!-- Profile Image -->
        <div class="mb-4">
            <label class="block text-gray-700">Profile Image</label>
            <input type="file" name="profile_image" class="w-full border px-3 py-2 rounded">

            @if($admin->profile_image)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $admin->profile_image) }}" class="w-20 h-20 object-cover rounded">
                </div>
            @endif
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Profile</button>
        </div>
    </form>
</div>
@endsection
