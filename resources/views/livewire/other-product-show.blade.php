<div>
@if (!empty($others))
    <section class="bg-gray-100 py-8 px-4">
        <div class="max-w-7xl mx-auto">
            @php
                // যদি তুমি জানো এইটা 'panjabi' ক্যাটেগরির পণ্য
                $category = \App\Models\Category::where('slug', 'others')->first(); // <== এই slug তুমি নিজে set করবে

                $slugs = [];

                while ($category) {
                    array_unshift($slugs, $category->slug);
                    $category = $category->parent;
                }

                $path = implode('/', $slugs);
            @endphp

            <a href="{{ route('products.by-category', $path) }}">
                <h1>অন্যান্য পণ্য সমূহ দেখুন </h1>
            </a>

            <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2">
                @foreach($others as $other)
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 p-2 relative group">
                        
                        {{-- Product Image --}}
                        <img src="{{ asset('storage/' . $other->product_image) }}" 
                            alt="{{ $other->title }}" 
                            class="w-full h-40 object-cover rounded-md mb-3 transform group-hover:scale-105 transition duration-300">

                        {{-- Title --}}
                        @php
                            $title = $other->title;
                            $length = Str::length($title);
                            if ($length > 25) {
                                $displayTitle = Str::substr($title, 0, 25);
                            } elseif ($length < 25) {
                                $displayTitle = $title . str_repeat('.', 25 - $length);
                            } else {
                                $displayTitle = $title;
                            }
                        @endphp

                        <h3 class="text-md font-semibold text-gray-800 mb-1 truncate hover:text-blue-600 transition">{{ $displayTitle }}</h3>

                        {{-- Stock Status --}}
                        @if($other->status == 'in stock')
                            <p class="text-green-600 text-sm mb-1">✅ {{ $other->status }}</p>
                        @else
                            <p class="text-red-600 text-sm mb-1">❌ {{ $other->status }}</p>
                        @endif

                        {{-- Price --}}
                        <p class="text-green-700 text-lg font-bold">
                            ৳{{ number_format($other->offer_price, 2) }}
                            <span class="text-gray-400 text-sm ml-1">
                                <del>৳{{ number_format($other->real_price, 2) }}</del>
                            </span>
                        </p>

                        {{-- Buttons --}}
                        <div class="mt-4 flex justify-between items-center">
                            <a href="{{ route('cart.details', $other->id) }}" 
                            class="text-sm bg-gray-200 text-gray-800 p-2 rounded hover:bg-gray-300 transition">
                                View
                            </a>

                            <livewire:add-to-cart 
                                :productId="$other->id" 
                                :key="$other->id" 
                                buttonClass="text-sm bg-blue-500 text-white p-2 rounded hover:bg-purple-600 transition shadow hover:shadow-lg"
                            />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endif

</div>