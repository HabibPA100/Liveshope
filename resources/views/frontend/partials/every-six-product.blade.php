@foreach($categoriesWithProducts as $category)
    <section class="mb-10 bg-gray-100 py-6 px-4 rounded-lg">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-4">
                {{ $category->name }}
                <a href="{{ route('products.by-category', $category->slug) }}" class="text-blue-500 text-sm ml-2 hover:underline">
                    আরও দেখুন
                </a>
            </h2>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach($category->products as $product)
                    <div class="bg-white p-3 rounded shadow hover:shadow-md transition">
                        <img src="{{ asset('storage/' . $product->product_image) }}" class="w-full h-32 object-cover rounded mb-2">
                        <h3 class="text-sm font-semibold truncate">{{ $product->title }}</h3>
                        <p class="text-green-600 font-bold text-sm">৳{{ number_format($product->offer_price, 2) }}</p>

                        <div class="flex justify-between items-center mt-2">
                            <a href="{{ route('cart.details', $product->id) }}" class="text-xs bg-gray-200 px-2 py-1 rounded">View</a>
                            <livewire:add-to-cart :productId="$product->id" :key="$product->id"/>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endforeach
