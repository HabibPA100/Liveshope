@extends('frontend.layouts.admin-layouts.admin-master')

@section('content')
    <div class="p-4 max-w-xl mx-auto">
        <h2 class="text-xl font-bold mb-4">Add New Plan</h2>

        <form action="{{ route('plans.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label>Duration</label>
                <input type="text" name="duration" class="w-full border p-2" required>
            </div>

            <div>
                <label>Price</label>
                <input type="number" name="price" class="w-full border p-2" required>
            </div>

            <div>
                <label>Tag (optional)</label>
                <input type="text" name="tag" class="w-full border p-2">
            </div>

            <div>
                <label>
                    <input type="checkbox" name="highlight" value="1"> Highlight this plan?
                </label>
            </div>

            <div>
                <button class="bg-blue-500 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
@endsection
