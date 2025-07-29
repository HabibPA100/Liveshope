<div class="overflow-hidden">
  <div class="flex transition-transform duration-700 ease-in-out slide-track">
    @foreach($rightSlideItems as $rightSlideItem)
      <div class="flex-shrink-0 w-1/2 md:w-1/5 px-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
        <div class="border rounded-lg shadow hover:shadow-md bg-white p-3">
          <a href="{{ route('cart.details', $rightSlideItem->id) }}">
            <img src="{{ asset('storage/' . $rightSlideItem->product_image) }}" alt="{{ $rightSlideItem->title }}" class="w-full h-40 object-cover rounded">
            
            @php
                $title = $rightSlideItem->title;
                $length = Str::length($title);
                if ($length > 25) {
                    $displayTitle = Str::substr($title, 0, 25);
                } elseif ($length < 25) {
                    $displayTitle = $title . str_repeat('.', 25 - $length);
                } else {
                    $displayTitle = $title;
                }
            @endphp

            <h3 class="font-semibold text-md mt-2 text-gray-800 hover:text-blue-600 transition">
                {{ $displayTitle }}
            </h3>

            <div class="text-sm mt-1">
              <p class="text-gray-700">
                ৳{{ number_format($rightSlideItem->offer_price, 2) }}
                <span class="line-through text-red-500 ml-2">
                  ৳{{ number_format($rightSlideItem->real_price, 2) }}
                </span>
              </p>
              @if($rightSlideItem->status == 'in stock')
                <p class="text-green-600 text-xs mt-1">✅ {{ $rightSlideItem->status }}</p>
              @else
                <p class="text-red-600 text-xs mt-1">❌ {{ $rightSlideItem->status }}</p>
              @endif
            </div>
          </a>
        </div>
      </div>
    @endforeach
  </div>
</div>
