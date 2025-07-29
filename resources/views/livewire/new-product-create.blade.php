<div class="max-w-5xl mx-auto px-4 py-8 overflow-hidden">
    <div class="flex justify-between">
        <h2 class="text-2xl font-bold mb-6">{{ $productId ? 'Edit Product' : 'Create New Product' }}</h2>
        <a href="{{ route('seller.dashboard') }}">Dashboard</a>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save" id="product-form" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg shadow-md">

    {{-- Title --}}
        <div>
            <label for="title" class="block font-medium mb-1">Title (গুরুত্বপূর্ণ *)</label>
            <input id="title" type="text" wire:model.defer="title" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Product Title" aria-label="Product Title">
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Description --}}
        <div class="md:col-span-2">
            <label for="description" class="block font-medium mb-1">Description (গুরুত্বপূর্ণ *)</label>
            <textarea id="description" wire:model.defer="description" class="w-full border-gray-300 rounded px-3 py-2 h-28 focus:ring-blue-500 focus:border-blue-500" placeholder="Product Description" aria-label="Product Description"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Product Image --}}
        <div>
            <label for="product_image" class="block font-medium mb-1">Product Image (200x200px) *</label>
            <input id="product_image" type="file" wire:model="product_image" class="w-full border-gray-300 rounded px-3 py-2 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @if (is_object($product_image) && method_exists($product_image, 'temporaryUrl'))
                <img src="{{ $product_image->temporaryUrl() }}" class="mt-2 w-24 h-24 object-cover rounded border">
            @elseif(is_string($product_image))
                <img src="{{ asset('storage/' . $product_image) }}" class="mt-2 w-24 h-24 object-cover rounded border">
            @endif
            @error('product_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Slash Image --}}
        <div>
            <label for="slash_image" class="block font-medium mb-1">Slash Image (400x400px) *</label>
            <input id="slash_image" type="file" wire:model="slash_image" class="w-full border-gray-300 rounded px-3 py-2 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @if (is_object($slash_image) && method_exists($slash_image, 'temporaryUrl'))
                <img src="{{ $slash_image->temporaryUrl() }}" class="mt-2 w-24 h-24 object-cover rounded border">
            @elseif(is_string($slash_image))
                <img src="{{ asset('storage/' . $slash_image) }}" class="mt-2 w-24 h-24 object-cover rounded border">
            @endif
            @error('slash_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Category Selector --}}
        <div class="md:col-span-2">
            @livewire('category-selector')
            @error('category') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Status --}}
        <div>
            <label for="status" class="block font-medium mb-1">Status</label>
            <select id="status" wire:model.defer="status" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="in stock">In Stock</option>
                <option value="out of stock">Out of Stock</option>
            </select>
        </div>

        {{-- Real & Offer Price --}}
        <div>
            <label for="real_price" class="block font-medium mb-1">Real Price (গুরুত্বপূর্ণ *)</label>
            <input id="real_price" type="number" step="0.01" wire:model.defer="real_price" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            @error('real_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div>
            <label for="offer_price" class="block font-medium mb-1">Offer Price (গুরুত্বপূর্ণ *)</label>
            <input id="offer_price" type="number" step="0.01" wire:model.defer="offer_price" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            @error('offer_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Stock Quantity --}}
        <div>
            <label for="stock_quantity" class="block font-medium mb-1">Stock Quantity (গুরুত্বপূর্ণ *)</label>
            <input id="stock_quantity" type="text" wire:model.defer="stock_quantity" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
            @error('stock_quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        {{-- Additional Fields --}}
        @foreach ([
            'sku' => 'SKU', 'brand' => 'Brand', 'discount_percent' => 'Discount (%)',
            'weight' => 'Weight (kg)', 'dimensions' => 'Dimensions (LxWxH)', 
            'rating' => 'Rating', 'quality' => 'Quality', 
            'warranty' => 'Warranty', 'shipping_info' => 'Shipping Info'
        ] as $field => $label)
            <div>
                <label for="{{ $field }}" class="block font-medium mb-1">{{ $label }}</label>
                <input id="{{ $field }}" type="text" wire:model.defer="{{ $field }}" class="w-full border-gray-300 rounded px-3 py-2 focus:ring-blue-500 focus:border-blue-500">
                @error($field) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        @endforeach

        {{-- Tags, Colors, Sizes --}}
        <div>
            <label for="tags" class="block font-medium mb-1">Tags (comma-separated)</label>
            <input id="tags" type="text" wire:model.defer="tags" class="w-full border-gray-300 rounded px-3 py-2">
        </div>
        <div>
            <label for="colors" class="block font-medium mb-1">Colors</label>
            <input id="colors" type="text" wire:model.defer="colors" class="w-full border-gray-300 rounded px-3 py-2" placeholder="e.g., red,blue">
        </div>
        <div>
            <label for="sizes" class="block font-medium mb-1">Sizes</label>
            <input id="sizes" type="text" wire:model.defer="sizes" class="w-full border-gray-300 rounded px-3 py-2" placeholder="e.g., S,M,L">
        </div>

        {{-- Published At --}}
        <div>
            <label for="published_at" class="block font-medium mb-1">Published At</label>
            <input id="published_at" type="date" wire:model="published_at" value="{{ \Carbon\Carbon::parse($published_at)->format('Y-m-d') }}" class="w-full border-gray-300 rounded px-3 py-2">
        </div>

        <div class="flex items-center space-x-3">
            <label for="is_featured" class="text-sm md:text-2xl font-medium text-red-700">এটি কি গিফট প্যাকেজ ?  </label>

            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" wire:model="is_featured" id="is_featured" name="is_featured" class="sr-only peer">
                
                <div class="w-11 h-6 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-500 rounded-full peer peer-checked:bg-blue-600 transition-all duration-300 ease-in-out"></div>
                
                <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-transform duration-300 transform peer-checked:translate-x-5"></div>
            </label>
        </div>

        {{-- Submit Button --}}
        <div class="md:col-span-2">
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition">
                {{ $productId ? 'Update Product' : 'Create Product' }}
            </button>
        </div>
    </form>

     @livewire('product-list')
</div>
