<div>
    <h2 class="text-xl font-bold mb-4">আপনার প্রাপ্ত অর্ডার সমূহ</h2>
    @forelse($orders as $order)
        <div class="border p-4 mb-3 rounded shadow">
            <p><strong>অর্ডার আইডি:</strong> {{ $order->unique_order_id }}</p>
            <p><strong>ক্রেতার নাম:</strong> {{ $order->name ?? 'অজানা' }}</p>
            <p><strong>অর্ডার সময় : </strong> {{ $order->created_at->timezone('Asia/Dhaka')->format('d M Y, h:i A') ?? 'অজানা' }}</p>
            {{-- <p><strong>ফোন:</strong> {{ $order->phone }}</p>
            <p><strong>ঠিকানা:</strong> {{ $order->delivery_address }}</p> --}}
            <p><strong>পণ্যসমূহ:</strong></p>
            <ul class="list-disc ml-5">
                @foreach($order->cart_items as $item)
                    @if($item['seller_id'] == $sellerId)
                        <li>{{ $item['name'] }} - Qty: {{ $item['quantity'] }} - {{ $item['price'] }}৳</li>
                    @endif
                @endforeach
            </ul>
        </div>
    @empty
        <p>আপনার কোনো অর্ডার পাওয়া যায়নি।</p>
    @endforelse
</div>
