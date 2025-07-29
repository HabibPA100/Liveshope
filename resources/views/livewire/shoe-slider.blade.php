<section class="bg-gray-100 py-6 px-4">
    <div class="max-w-7xl mx-auto">
        <h1 >Shoes shop</h1>
        <div class="flex flex-wrap -mx-2">
            @foreach($shoes as $shoe)
                <div class="w-full sm:w-1/2 lg:w-1/5 px-2 mb-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="left-bottom-border">
                        <div class="left-linear transition-all duration-300 transform p-2">
                            <img src="{{ asset('storage/' . $shoe->product_image) }}" class="w-full h-40 object-cover rounded hover:-translate-y-2 hover:scale-105 hover:opacity-90 transition duration-300" alt="{{ $shoe->title }}">
                            <h3 class="font-bold text-lg mt-3 text-gray-800 hover:text-blue-600 transition">{{ $shoe->title }}</h3>
                            <div class="text-xl font-bold text-blue-600">
                                <p class="text-green-700"> ৳{{ number_format($product->offer_price, 2) }} 
                                    <span class="text-gray-500"> 
                                        <del> ৳{{ number_format($product->real_price, 2) }} </del>
                                    </span>
                                </p> 
                            </div>
                            <div class="flex justify-between items-center pt-4">
                                <button class="text-sm bg-gray-100 text-gray-800 px-3 py-1 rounded hover:bg-gray-300 transition">View</button>
                                <button class="text-sm bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition shadow hover:shadow-lg">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>