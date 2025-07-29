<div x-data="{ sidebarOpen: false }" class="min-h-screen flex overflow-hidden mt-6">

    <!-- Mobile Sidebar Toggle Button -->
    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden fixed top-4 left-4 z-50 bg-blue-600 text-white p-2 rounded-md shadow-md">
        ☰
    </button>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        class="fixed lg:relative z-40 w-64 bg-white shadow-md h-full p-4 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:block">
        <h2 class="text-2xl font-bold text-blue-600 mb-6">Admin Panel</h2>
        <nav class="space-y-3">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">🏠 Dashboard</a>
            <a href="{{ route('all.buyer.show') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium"><i class="fa-solid fa-users"></i> <span>All Buyer</span></a>
            <a href="{{ route('all.seller.show') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium"><i class="fa-solid fa-scale-balanced"></i> <span>All Seller</span></a>
            <a href="{{ route('buyer.order.list') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">🛒 Orders</a>
            <a href="{{ route('plans.index') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">♻️ Plane</a>
            <a href="{{ route('admin.subscriptions') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">🪺 Subscriptions</a>
            <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">⛓ Add Category</a>
            <a href="{{ route('all.message') }}" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">💬 Messages</a>
            <a href="#" class="block px-3 py-2 rounded hover:bg-blue-100 text-gray-700 font-medium">⚙️ Settings</a>
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition w-full">
                        Logout
                    </button>
             </form>
        </nav>
    </aside>

    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
        class="fixed inset-0 bg-black opacity-30 z-30 lg:hidden"></div>

    <!-- Main Content -->
    <div class="flex-1 p-4 lg:p-6 overflow-x-hidden">
        <div class="mb-6">
            <h2 class="text-3xl font-semibold text-white py-3 ps-4 bg-red-700">Welcome, Admin!</h2>
            <p class="text-gray-500">Here is your dashboard overview.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-700">Total Products</h3>
                <p class="text-3xl font-semibold text-blue-600 mt-2">{{ $allProduct ?? '0'}}</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-700">Total Orders</h3>
                <p class="text-3xl font-semibold text-yellow-500 mt-2">{{ $totalOrder ?? '0'}}</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-700">Confirmed Order</h3>
                <p class="text-3xl font-semibold text-green-500 mt-2">{{ $confirmedOrder ?? '0'}}</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-700">Delivered Order</h3>
                <p class="text-3xl font-semibold text-green-500 mt-2">{{ $deliveredOrder ?? '0' }}</p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-700">Total Amount:</h3>
                <p class="text-3xl font-semibold text-red-700 mt-2"><span> ৳{{ number_format($totalDeliveredAmount, 2) }}</span></p>
            </div>
            <div class="bg-white shadow-md rounded-xl p-6">
                <a href="{{ route('all.message') }}">
                    <h3 class="text-xl font-bold text-gray-700">Messages:</h3>
                    <p class="text-3xl font-semibold text-red-700 mt-2">{{ $totalMessage ?? '0' }}</p>
                </a>
            </div>
            
        </div>

        <div class="mt-10 bg-white shadow-md rounded-xl p-6 overflow-auto">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Recent Orders</h2>
            <table class="w-full min-w-[400px] table-auto text-left border">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-2 border">#Unique Order ID</th>
                        <th class="p-2 border">Customer</th>
                        <th class="p-2 border">Amount</th>
                        <th class="p-2 border">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-2 border">#{{ $order->unique_order_id }}</td>
                            <td class="p-2 border">
                                {{ $order->name ?? 'Unknown' }}
                            </td>
                            <td class="p-2 border">
                                {{ number_format($order->total, 2) }} ৳
                            </td>
                            <td class="p-2 border">
                                <a href="{{ route('order-status.edit', $order->id) }}">
                                    {{ $order->status }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-4 text-center text-gray-500">
                                কোনো অর্ডার পাওয়া যায়নি।
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</div>