<div>
@if ($gifts->isNotEmpty())
    <section class="bg-gray-100 py-3 px-4">
        <div class="max-w-7xl mx-auto">
            @php
                $firstProduct = $gifts->last();
                $category = $firstProduct?->category; // null safe

                $slugs = [];

                while ($category) {
                    array_unshift($slugs, $category->slug);
                    $category = $category->parent;
                }

                $path = implode('/', $slugs);
            @endphp
            <a href="{{ route('products.by-category', $path) }}">
                <h1>প্রিয় গিফট প্যাকস</h1>
            </a>
            <div class="flex flex-wrap -mx-2">
                @foreach($gifts as $gift)
                    <div class="w-full sm:w-1/2 lg:w-1/5 px-2 mb-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="rotating-border">
                            <div class="card-inner transition-all duration-300 transform">
                                <img src="{{ asset('storage/' . $gift->product_image) }}" class="w-full h-40 object-cover rounded hover:-translate-y-2 hover:scale-105 hover:opacity-90 transition duration-300" alt="{{ $gift->title }}">
                                @php
                                    $title = $gift->title;
                                    $length = Str::length($title);
                                    if ($length > 25) {
                                        $displayTitle = Str::substr($title, 0, 25); // কেটে ২৫ অক্ষর নেওয়া
                                    } elseif ($length < 25) {
                                        $displayTitle = $title . str_repeat('.', 25 - $length); // যতটুকু ঘাটতি, ততগুলো . যোগ
                                    } else {
                                        $displayTitle = $title; // ঠিক ২৫ হলে, যেভাবে আছে সেভাবেই
                                    }
                                @endphp

                                <h3 class="font-bold text-lg mt-3 text-gray-800 hover:text-blue-600 transition">
                                    {{ $displayTitle }}
                                </h3>
                                @if($gift->status == 'in stock')
                                    <p class="text-green-700">✅{{ $gift->status }}</p>
                                @else
                                    <p class="text-red-700">❌{{ $gift->status }}</p>
                                @endif
                                <div class="text-xl font-bold text-blue-600">
                                    <p class="text-green-700"> ৳{{ number_format($gift->offer_price, 2) }} 
                                        <span class="text-gray-500"> 
                                            <del> ৳{{ number_format($gift->real_price, 2) }} </del>
                                        </span>
                                    </p> 
                                </div>

                                <div class="flex justify-between items-center pt-4">

                                    <a href="{{ route('cart.details', $gift->id) }}" class="text-sm bg-gray-100 text-gray-800 px-3 p-2 rounded hover:bg-gray-300 transition">View</a>

                                    <livewire:add-to-cart 
                                            :productId="$gift->id" 
                                            :key="$gift->id" 
                                            buttonClass="text-sm bg-red-400 text-white p-2 rounded hover:bg-purple-600 transition shadow hover:shadow-lg"
                                        />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endif
</div>