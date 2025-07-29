@extends('frontend.layouts.admin-layouts.admin-master')

@section('content')
    <div class="container max-w-[1200px] mx-auto p-4">
        <h2 class="text-xl font-bold mb-4">All Plans</h2>

        <a href="{{ route('plans.create') }}" class="bg-green-500 text-white px-4 py-2 rounded">+ Add New Plan</a>

        <table class="mt-4 w-full border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2">Duration</th>
                    <th class="p-2">Price</th>
                    <th class="p-2">Tag</th>
                    <th class="p-2">Highlight</th>
                    <th class="p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($plans as $plan)
                    <tr class="border-t">
                        <td class="p-2">{{ $plan->duration }}</td>
                        <td class="p-2">৳{{ $plan->price }}</td>
                        <td class="p-2">{{ $plan->tag }}</td>
                        <td class="p-2">{{ $plan->highlight ? '✅' : '❌' }}</td>
                        <td class="p-2">
                            <form action="{{ route('plans.destroy', $plan) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="text-red-500">🗑️ Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
