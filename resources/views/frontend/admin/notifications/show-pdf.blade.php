<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <title>নোটিফিকেশন ডিটেইলস</title>
    @php
        $qrcodesPath = public_path('storage/qrcodes/' . $data['unique_order_id'] . '.png');
    @endphp
    <style>
        @font-face {
            font-family: 'BanglaFont';
            src: url('file://{{ public_path('fonts/SolaimanLipi.ttf') }}') format('truetype');
        }

        body {
            font-family: 'BanglaFont', sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
        .section {
            margin-bottom: 20px;
        }
        .border {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        h2, h3, h4 {
            margin-bottom: 10px;
        }
        ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <h2>নোটিফিকেশন ডিটেইলস</h2>
    <div class="section">
        <p><strong>বার্তা:</strong> {{ $data['message'] }}</p>
        <p><strong>অর্ডার আইডি:</strong> #{{ $data['unique_order_id'] ?? 'N/A' }}</p>
        <p><strong>মোট অর্ডার:</strong> {{ $data['total'] }} টাকা</p>
        <p><strong>পাওয়ার সময়:</strong> {{ $notification->created_at->diffForHumans() }}</p>
    </div>

    @if(isset($data['buyer']))
        <div class="section border">
            <h4>ক্রেতার তথ্য</h4>
            <ul>
                <li><strong>নাম:</strong> {{ $data['buyer']['name'] ?? 'N/A' }}</li>
                <li><strong>ইমেইল:</strong> {{ $data['buyer']['email'] ?? 'N/A' }}</li>
                <li><strong>ফোন:</strong> {{ $data['buyer']['phone'] ?? 'N/A' }}</li>
                <li><strong>ডেলিভারি স্থান:</strong> {{ $data['buyer']['area'] ?? 'N/A' }}</li>
                <li><strong>ডেলিভারি এরিয়া:</strong> {{ $data['delivery_area'] ?? 'N/A' }}</li>
            </ul>
        </div>
    @endif

    @if($cartItems->count())
        <div class="section">
            <h3>অর্ডারকৃত পণ্য ও সেলার তথ্য</h3>

            @foreach($cartItems as $item)
                @php $seller = $sellers[$item['seller_id']] ?? null; @endphp
                <div class="border">
                    <p><strong>পণ্যের নাম:</strong> {{ $item['name'] }}</p>
                    <p><strong>পরিমাণ:</strong> {{ $item['quantity'] }}</p>
                    <p><strong>সেলার:</strong> {{ $seller->name ?? 'N/A' }}</p>
                    <ul>
                        <li><strong>মোবাইল:</strong> {{ $seller->phone ?? 'N/A' }}</li>
                        <li><strong>ঠিকানা:</strong> {{ $seller->address ?? 'N/A' }}</li>
                    </ul>
                </div>
            @endforeach
        </div>

        @if($qrCodeExists)
            <img src="file:///{{ str_replace('\\', '/', public_path('storage/' . $qrCodePath)) }}" style="width: 150px;" alt="QR Code">
        @else
            <p style="color: red;">QR কোড পাওয়া যায়নি।</p>
        @endif
    @else
        <p>এই নোটিফিকেশনে কোনো পণ্য তথ্য নেই।</p>
    @endif

</body>
</html>
