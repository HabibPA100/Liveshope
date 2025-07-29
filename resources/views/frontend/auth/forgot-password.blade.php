@extends('frontend.layouts.master')

@section('content')
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="max-w-md w-full bg-white p-6 rounded shadow">
            <h2 class="text-2xl font-bold text-center mb-4">{{ ucfirst($type) }} Password Reset</h2>

            @if(session('status'))
            <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
                {{ session('status') }}
            </div>
            @endif

            <form method="POST" action="{{ route('password.email', $type) }}">
            @csrf
            <label>Email</label>
            <input type="email" name="email" required
                    class="w-full border px-3 py-2 mt-1 rounded mb-4">
            @error('email') <p class="text-red-600">{{ $message }}</p> @enderror

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Send Link</button>
            </form>
        </div>
    </div>

@endsection 