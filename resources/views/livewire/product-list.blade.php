<div class="bg-white p-6 rounded shadow max-w-6xl mx-auto mt-8">
    <h2 class="text-xl font-bold mb-4">Product List</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <table class="w-full table-auto border-collapse">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">#</th>
                <th class="p-2 border">Title</th>
                <th class="p-2 border">Price</th>
                <th class="p-2 border">Stock</th>
                <th class="p-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $index => $product)
                <tr class="hover:bg-gray-50">
                    <td class="p-2 border">{{ $index + 1 }}</td>
                    <td class="p-2 border">{{ $product->title }}</td>
                    <td class="p-2 border">৳{{ $product->offer_price }}</td>
                    <td class="p-2 border">{{ $product->stock_quantity }}</td>
                    <td class="p-2 border space-x-2">
                        <button wire:click="edit({{ $product->id }})"
                                class="text-blue-600 hover:underline text-sm">Edit</button>
                        <button wire:click="delete({{ $product->id }})"
                                onclick="confirm('Delete this product?') || event.stopImmediatePropagation()"
                                class="text-red-600 hover:underline text-sm">Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-4 text-center text-gray-500">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
