<section class="bg-gray-100 py-8 px-4">
    <div class="max-w-7xl mx-auto">
        @forelse($categoryProducts as $key => $data)
            <div class="mb-10">
                <!-- Section Header -->
                <div class="flex justify-between items-center mb-3">
                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $data['name'] }}
                    </h2>
                    <a href="{{ route('products.by-category', $key) }}" class="text-sm text-blue-600 hover:underline">
                        আরও দেখুন →
                    </a>
                </div>

                <!-- Product Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    @foreach($data['products'] as $product)
                        <div 
                            class="mb-6" 
                            data-aos="fade-up" 
                            data-aos-delay="{{ $loop->index * 100 }}"
                        >
                            <div class="rotating-border">
                                <div class="card-inner transition-all duration-300 transform">
                                    <!-- Product Image -->
                                    <img 
                                        src="{{ asset('storage/' . $product->product_image) }}" 
                                        alt="{{ $product->title }}" 
                                        class="w-full h-40 object-cover rounded hover:-translate-y-2 hover:scale-105 hover:opacity-90 transition duration-300"
                                    >

                                    <!-- Product Title -->
                                    @php
                                        $title = $product->title;
                                        $length = Str::length($title);
                                        if ($length > 25) {
                                            $displayTitle = Str::substr($title, 0, 25);
                                        } elseif ($length < 25) {
                                            $displayTitle = $title . str_repeat('.', 25 - $length);
                                        } else {
                                            $displayTitle = $title;
                                        }
                                    @endphp

                                    <h3 class="font-bold text-lg mt-3 text-gray-800 hover:text-blue-600 transition">
                                        {{ $displayTitle }}
                                    </h3>

                                    <!-- Stock Status -->
                                    <p class="{{ $product->status == 'in stock' ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $product->status == 'in stock' ? '✅' : '❌' }}{{ $product->status }}
                                    </p>

                                    <!-- Pricing -->
                                    <div class="text-xl font-bold text-blue-600">
                                        <p class="text-green-700">
                                            ৳{{ number_format($product->offer_price, 2) }}
                                            <span class="text-gray-500">
                                                <del>৳{{ number_format($product->real_price, 2) }}</del>
                                            </span>
                                        </p>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex justify-between items-center pt-4">
                                        <a 
                                            href="{{ route('cart.details', $product->id) }}" 
                                            class="text-sm bg-gray-100 text-gray-800 px-3 py-1 rounded hover:bg-gray-300 transition"
                                        >
                                            View
                                        </a>

                                        <livewire:add-to-cart 
                                            :productId="$product->id" 
                                            :key="$product->id" 
                                            buttonClass="text-sm bg-blue-500 text-white px-4 py-2 rounded hover:bg-purple-600 transition shadow hover:shadow-lg"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <p class="text-gray-600">কোন পণ্য পাওয়া যায়নি।</p>
        @endforelse
    </div>
</section>
