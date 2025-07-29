<div>
    <form class="flex items-center w-full" wire:submit.prevent="searchProducts">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <!-- icon -->
                <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                </svg>
            </div>
            <input
                type="text"
                wire:model="search"
                id="simple-search"
                placeholder="Search product title..."
                class="w-full pl-10 p-2.5 text-sm rounded-lg border border-gray-300 text-green-500 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-white"
            />
        </div>
        <button
            type="submit"
            class="ml-2 p-2.5 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>

    <!-- Search Results -->
    @if($hasSearched)
        <div class="mt-4">
            @forelse($products as $product)
                <a 
                    href="{{ route('cart.details', $product->id) }}" 
                    class="block p-2 border rounded-lg mb-2 bg-white shadow hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:text-white"
                >
                    {{ $product->title }}
                </a>
            @empty
                <p class="text-gray-500 dark:text-gray-300 mt-2">No products found.</p>
            @endforelse
        </div>
    @endif

</div>
