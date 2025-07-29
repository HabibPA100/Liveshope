
<header class="bg-white shadow-md w-full z-10" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <!-- Logo / Title -->
        <div class="flex items-center space-x-2">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path>
            </svg>
            <a href="{{ url('/') }}">
                <span class="hidden md:block text-xl font-bold text-gray-800">Go To Home</span>
            </a>
        </div>

        <!-- Right side icons -->
        <div class="flex items-center space-x-6">
            <!-- Notification -->
            <div class="relative">
                <livewire:buyer.buyer-notification-bell />
            </div>

            <!-- Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    @if(auth('buyer')->check())
                        @php
                            $buyer = auth('buyer')->user();
                        @endphp
                        <img class="w-8 h-8 rounded-full object-cover"
                            src="{{ $buyer->profile_image ? asset('storage/' . $buyer->profile_image) : 'https://i.pravatar.cc/40?img=12' }}" alt="User avatar">
                        <span class="hidden md:inline text-gray-700 font-medium">{{ $buyer->name }}</span>
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path d="M19 9l-7 7-7-7"></path>
                        </svg>
                     @endif
                </button>

                <!-- Dropdown Menu -->
                <div
                    x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg z-50"
                >
                    <a href="#"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <a href="#"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
