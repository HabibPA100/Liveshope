<div x-data="{ sidebarOpen: false }" class="min-h-screen flex overflow-hidden mt-6">

    <!-- Mobile Sidebar Toggle Button -->
    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden fixed top-4 left-4 z-50 bg-blue-600 text-white p-2 rounded-md shadow-md">
        ☰
    </button>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed lg:relative z-40 w-64 bg-white shadow-md h-full p-4 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:block">
        <h2 class="text-2xl font-bold text-blue-600 mb-6">Seller Panel</h2>
        <nav class="space-y-3">
            <a href="{{ route('seller.dashboard') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">🏠 Dashboard</a>
            <a href="{{ route('create.product') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">📦 My Products</a>
            <a href="{{ route('show.order.list') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">🛒 Orders</a>
            <a href="{{ route('commission') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">💬 Commissions</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">⚙️ Settings</a>
            <button wire:click="logout" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition w-full">
                Logout
            </button>
        </nav>
    </aside>

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 bg-black opacity-30 z-30 lg:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 p-4 lg:p-6 overflow-x-hidden">
        <div class="mb-6">
            <h1>Welcome, Seller!</h1>
            <p class="text-gray-500">Here is your dashboard overview.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-700">Total Products</h3>
                <p class="text-3xl font-semibold text-blue-600 mt-2">{{ $allProduct ?? '0' }}</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-700">Pending Orders</h3>
                <p class="text-3xl font-semibold text-yellow-500 mt-2">000</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-700">Messages</h3>
                <p class="text-3xl font-semibold text-green-500 mt-2">000</p>
            </div>
        </div>

        <div class="mt-10 bg-white shadow-md rounded-xl p-6 overflow-auto">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Recent Orders</h2>
            <table class="w-full min-w-[400px] table-auto text-left">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-2">#Order</th>
                        <th class="p-2">Customer</th>
                        <th class="p-2">Amount</th>
                        <th class="p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        {{-- ফিল্টার করে শুধু seller-এর প্রোডাক্টগুলো দেখানো --}}
                        @php
                            $items = is_array($order->cart_items) 
                                ? $order->cart_items 
                                : json_decode($order->cart_items, true);

                            $hasSellerProduct = false;
                            foreach ($items as $item) {
                                if (isset($item['seller_id']) && $item['seller_id'] == $user->id) {
                                    $hasSellerProduct = true;
                                    break;
                                }
                            }
                        @endphp 

                        @if ($hasSellerProduct)
                            <tr class="border-b">
                                <td class="p-2">#{{ $order->unique_order_id }}</td>
                                <td class="p-2">{{ $order->name }}</td>
                                <td class="p-2">৳{{ number_format($order->total - $order->delivery_charge, 2) }}</td>
                                <td class="p-2 text-yellow-600 capitalize">{{ $order->status ?? 'Pending' }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">কোন অর্ডার পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>
</div>