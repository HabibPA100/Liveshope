@extends('frontend.layouts.admin-layouts.admin-master')
@section('title', 'List of all Message')
@section('content')
    <div class="overflow-x-auto p-4">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
            <tr>
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Email</th>
                <th class="py-3 px-6 text-left">Message</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            @foreach ($messages as $user)
                <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-3 px-6">{{ $user->name }}</td>
                <td class="py-3 px-6">
                    <a href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $user->email }}" 
                    target="_blank" 
                    class="text-blue-600 underline hover:text-blue-800">
                        {{ $user->email }}
                    </a>
                </td>
                <td class="py-3 px-6">{{ $user->message }}</td>
                </tr>
            @endforeach

            <!-- More rows can go here -->
            </tbody>
        </table>
    </div>

@endsection