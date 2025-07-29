<section class="slider mt-2">
    <div class="relative hidden md:block w-full max-w-7xl h-[400px] mx-auto overflow-hidden rounded-lg shadow-lg">
    <!-- Slides -->
        <div id="slider" class="flex transition-transform duration-500">
            <img src="{{ asset('frontend/images/slider/img1.jpg') ?? 'Please give me an image path' }}" class="w-full h-[400px] shrink-0" alt="Slide 1">
            <img src="{{ asset('frontend/images/slider/img2.jpg') ?? 'Please give me an image path' }}" class="w-full h-[400px] shrink-0" alt="Slide 2">
            <img src="{{ asset('frontend/images/slider/img3.jpg') ?? 'Please give me an image path' }}" class="w-full h-[400px] shrink-0" alt="Slide 3">
            <img src="{{ asset('frontend/images/slider/img4.jpg') ?? 'Please give me an image path' }}" class="w-full h-[400px] shrink-0" alt="Slide 3">
            <img src="{{ asset('frontend/images/slider/img5.jpg') ?? 'Please give me an image path' }}" class="w-full h-[400px] shrink-0" alt="Slide 3">
            <img src="{{ asset('frontend/images/slider/img6.jpg') ?? 'Please give me an image path' }}" class="w-full h-[400px] shrink-0" alt="Slide 3">
        </div>

        <!-- Left Arrow -->
        <button id="prevBtn" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-200">
        ⬅️
        </button>

        <!-- Right Arrow -->
        <button id="nextBtn" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow hover:bg-gray-200">
        ➡️
        </button>
    </div>
</section>