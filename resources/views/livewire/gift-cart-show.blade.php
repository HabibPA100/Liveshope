<div>
@if ($gifts->isNotEmpty())
    <section class="bg-gray-100 py-3 px-4">
        <div class="max-w-7xl mx-auto">
            <a href="{{ route('products.featured-gifts') }}">
                <h1 class="one_design">প্রিয় গিফট প্যাকস</h1>
            </a>
            <div class="flex flex-wrap -mx-2">
                @foreach($gifts as $gift)
                    <div class="w-1/2 lg:w-1/5 px-2 mb-6">
                        <div class="h-full flex flex-col justify-between border rounded-lg shadow bg-white overflow-hidden">
                            {{-- Image --}}
                            <img src="{{ asset('storage/' . $gift->product_image) }}" 
                                 class="w-full h-40 object-cover" 
                                 alt="{{ $gift->title }}">

                            {{-- Title --}}
                            @php
                                $title = $gift->title;
                                $length = Str::length($title);
                                if ($length > 25) {
                                    $displayTitle = Str::substr($title, 0, 25);
                                } elseif ($length < 25) {
                                    $displayTitle = $title . str_repeat('.', 25 - $length);
                                } else {
                                    $displayTitle = $title;
                                }
                            @endphp
                            <div class="p-3 flex flex-col flex-grow justify-between">
                                <h3 class="font-bold text-md text-gray-800 hover:text-blue-600 transition min-h-[3rem]">
                                    {{ $displayTitle }}
                                </h3>

                                {{-- Stock --}}
                                <p class="{{ $gift->status == 'in stock' ? 'text-green-700' : 'text-red-700' }}">
                                    {{ $gift->status == 'in stock' ? '✅' : '❌' }}{{ $gift->status }}
                                </p>

                                {{-- Price --}}
                                <div class="text-xl font-bold text-blue-600 mt-1">
                                    <p class="text-green-700">
                                        ৳{{ number_format($gift->offer_price, 2) }} 
                                        <span class="text-gray-500">
                                            <del>৳{{ number_format($gift->real_price, 2) }}</del>
                                        </span>
                                    </p>
                                </div>

                                {{-- Buttons --}}
                                <div class="flex justify-between items-center mt-4">
                                    <a href="{{ route('cart.details', $gift->id) }}" 
                                       class="text-sm bg-gray-100 text-gray-800 px-3 py-2 rounded hover:bg-gray-300 transition">
                                       View
                                    </a>

                                    <livewire:add-to-cart 
                                        :productId="$gift->id" 
                                        :key="$gift->id" 
                                        buttonClass="text-sm bg-red-400 text-white px-3 py-2 rounded hover:bg-purple-600 transition shadow hover:shadow-lg"
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