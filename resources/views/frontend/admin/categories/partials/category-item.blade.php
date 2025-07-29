<li class="ml-{{ $level * 4 }}">
    <div class="flex items-center justify-between bg-white border rounded px-4 py-2 shadow hover:bg-gray-50 transition">
        <div class="text-gray-800 font-medium">
            {!! str_repeat('<span class="text-gray-400">—</span> ', $level) !!} {{ $category->name }}
        </div>

        <div class="space-x-2 text-sm">
            <a href="{{ route('admin.categories.edit', $category) }}"
               class="text-blue-600 hover:underline">✏️ Edit</a>

            <form action="{{ route('admin.categories.destroy', $category) }}"
                  method="POST"
                  class="inline"
                  onsubmit="return confirm('Are you sure you want to delete this category?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">🗑️ Delete</button>
            </form>
        </div>
    </div>

    @if($category->childrenRecursive->isNotEmpty())
        <ul class="mt-1 ml-4 space-y-1">
            @foreach($category->childrenRecursive as $child)
                @include('frontend.admin.categories.partials.category-item', ['category' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>
