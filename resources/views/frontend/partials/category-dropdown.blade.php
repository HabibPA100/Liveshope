<li x-data="{ open: false }" class="transition-all duration-200">
    <div class="flex justify-between items-center bg-gray-100 hover:bg-indigo-100 px-4 py-2 rounded-lg cursor-pointer group"
         @click="open = !open">

        <a href="{{ route('products.by-category', getCategoryPath($category)) }}"
           class="text-gray-800 group-hover:text-indigo-600 font-medium text-base">
            {{ str_repeat('— ', $level) . $category->name }}
        </a>

        @if($category->childrenRecursive->isNotEmpty())
            <svg :class="{ 'rotate-90': open }"
                class="w-5 h-5 text-gray-500 transition-transform duration-300"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 5l7 7-7 7" />
            </svg>
        @endif
    </div>

    @if($category->childrenRecursive->isNotEmpty())
        <ul x-show="open" x-transition
            class="ml-4 mt-2 border-l-2 border-indigo-200 pl-4 space-y-2">
            @foreach ($category->childrenRecursive as $child)
                @include('frontend.partials.category-dropdown', ['category' => $child, 'level' => $level + 1])
            @endforeach
        </ul>
    @endif
</li>
