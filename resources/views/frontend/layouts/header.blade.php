<!-- Wrapper -->
<div class="w-full bg-gray-900 overflow-x-hidden">
    <hr class="border-t border-white">

    <!-- Navbar Section -->
    <div class="w-full lg:bg-black px-4 py-1 text-white">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between relative lg:h-20">

            <!-- Flex Item 1: Logo & Tagline -->
            <div class="flex flex-col items-start">
                <a href="{{ url('/') }}">
                    <h2 class="text-xl sm:text-2xl font-bold">Live Shope</h2>
                </a>
                <p class="text-xs sm:text-sm text-gray-300">Believe yourself and to God</p>
            </div>

            <!-- Flex Item 2: Center Title (only on large screen) -->
            <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2">
                <a href="{{ url('/') }}">
                    <h2 class="text-white text-3xl font-semibold">Live Shope</h2>
                </a>
            </div>

            <!-- Flex Item 3: Auth Links & Cart -->
            <div class="flex items-center space-x-3 sm:space-x-5">
                <a href="{{ route('login') }}" class="hover:underline text-sm whitespace-nowrap">Log In</a>
                <livewire:cart-icon />
            </div>

        </div>
    </div>
</div>

<!-- Search Section -->
<div class="container w-[300px] md:w-[768px] mx-auto my-2">
    @livewire('product-search')
</div>
