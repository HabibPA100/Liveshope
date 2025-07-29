<div class="space-y-4">
    @foreach($levels as $index => $categories)
        <div>
            <label for="category-{{ $index }}" class="block text-sm font-medium text-gray-700">
                {{ $index === 0 ? 'মেইন ক্যাটেগরি নির্বাচন করুন' : 'সাব ক্যাটেগরি স্তর '.($index+1) }}
            </label>
            <select
                id="category-{{ $index }}"
                wire:model.live="selectedCategories.{{ $index }}"
                wire:key="category-{{ $index }}-{{ $selectedCategories[$index] ?? 'none' }}"
                class="mt-1 block w-full border-gray-300 rounded-md"
            >
                <option value="">-- নির্বাচন করুন --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ str_repeat('— ', $index) . $category->name }}</option>
                @endforeach
            </select>
        </div>
    @endforeach

    @if(!empty($selectedCategories))
        @php
            $names = \App\Models\Category::whereIn('id', $selectedCategories)->pluck('name')->toArray();
        @endphp
        <div class="mt-4 bg-green-50 border border-green-200 text-green-800 p-2 rounded">
            ✅ নির্ধারিত\Category: {{ implode(' > ', $names) }}
        </div>
    @endif
</div>
