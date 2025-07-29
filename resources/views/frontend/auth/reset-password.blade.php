@extends('frontend.layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="max-w-md w-full bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold text-center mb-4">Reset {{ ucfirst($type) }} Password</h2>

            <form method="POST" action="{{ route('password.update', $type) }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label>Email</label>
            <input type="email" name="email" required class="w-full border px-3 py-2 mt-1 rounded mb-4">
            
            <label>New Password</label>
            <input type="password" name="password" required class="w-full border px-3 py-2 mt-1 rounded mb-4">
            
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" required class="w-full border px-3 py-2 mt-1 rounded mb-4">

            <button type="submit" class="w-full bg-green-600 text-white py-2 rounded">Reset Password</button>
            </form>
        </div>
    </div>

@endsection 