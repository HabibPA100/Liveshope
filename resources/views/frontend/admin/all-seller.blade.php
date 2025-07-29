@extends('frontend.layouts.admin-layouts.admin-master')
@section('title', 'List of all seller')
@section('content')
    <div class="overflow-x-auto p-4">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
            <tr>
                <th class="py-3 px-6 text-left">Full Name</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Phone</th>
                <th class="py-3 px-6 text-left">Shop Name</th>
                <th class="py-3 px-6 text-left">Address</th>
                <th class="py-3 px-6 text-left">NID / BC</th>
                <th class="py-3 px-6 text-left">Status</th>
                <th class="py-3 px-6 text-left">Profile Image</th>
                <th class="py-3 px-6 text-center">Action</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            @foreach ($sellers as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-3 px-6">{{ $user->name }}</td>
                <td class="py-3 px-6">{{ $user->email }}</td>
                <td class="py-3 px-6">{{ $user->phone }}</td>
                <td class="py-3 px-6">{{ $user->store_name ?? 'Null' }}</td>
                <td class="py-3 px-6">{{ $user->address }}</td>
                <td class="py-3 px-6">{{ $user->national_id }}</td>
                <td class="py-3 px-6">{{ $user->status }}</td>
                <td class="py-3 px-6">
                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="w-10 h-10 rounded-full object-cover">
                </td>
                <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center space-x-2">
                    <!-- Edit Button -->
                    <a href="{{ route('admin.seller.edit', $user->id) }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">Edit</a>

                    <!-- Delete Form -->
                    <form action="{{ route('admin.seller.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">Delete</button>
                    </form>
                    
                </div>
                </td>
                </tr>
            @endforeach

            <!-- More rows can go here -->
            </tbody>
        </table>
    </div>

@endsection