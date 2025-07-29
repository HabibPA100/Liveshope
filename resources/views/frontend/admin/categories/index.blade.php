@extends('frontend.layouts.admin-layouts.admin-master')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1>📂 All Categories</h1>
    <a href="{{ route('admin.categories.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
        ➕ Add New Category
    </a>
</div>

@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

<ul class="space-y-2 my-5">
    @forelse($categories as $category)
        @include('frontend.admin.categories.partials.category-item', ['category' => $category, 'level' => 0])
    @empty
        <p>No categories found.</p>
    @endforelse
</ul>
@endsection
