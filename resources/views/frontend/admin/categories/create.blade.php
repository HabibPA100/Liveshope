@extends('frontend.layouts.admin-layouts.admin-master')

@section('content')
<h1 class="text-2xl font-semibold mb-4">Add Category</h1>

<form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
    @csrf
    <div>
        <label>Name</label>
        <input type="text" name="name" class="input" value="{{ old('name') }}">
        @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>Slug</label>
        <input type="text" name="slug" class="input" value="{{ old('slug') }}">
        @error('slug') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

    <div>
        <label>Parent Category</label>
        <select name="parent_id" class="input">
            <option value="">— None —</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>
                    {{ str_repeat('— ', $cat->parent_id ? 1 : 0) . $cat->name }}
                </option>
            @endforeach
        </select>
        @error('parent_id') <p class="text-red-500">{{ $message }}</p> @enderror
    </div>

    <button type="submit" class="btn btn-green">Save Category</button>
</form>
@endsection
