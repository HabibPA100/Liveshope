<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8" />
    <title>Order #{{ $order->unique_order_id }}</title>
    <style>
        @page {
            size: A4;
            margin: 40px;
        }
       @font-face {
            font-family: 'BanglaFont';
            src: url('file://{{ public_path('fonts/SolaimanLipi.ttf') }}') format('truetype');
        }
        body {
            font-family: 'BanglaFont', sans-serif;
            font-size: 13px;
            color: #111;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 0;
            font-size: 22px;
        }
        .order-info {
            font-size: 13px;
            text-align: right;
        }

        .section {
            margin-bottom: 25px;
        }
        .section-title {
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #222;
            border-bottom: 1px solid #ddd;
            padding-bottom: 4px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 6px 4px;
        }
        .info-table .label {
            font-weight: bold;
            width: 180px;
        }

        /* Items Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 13px;
        }
        .items-table th, .items-table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        .items-table th {
            background-color: #f2f2f2;
        }

        /* Summary Table */
        .summary-table {
            width: 300px;
            float: right;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .summary-table td {
            padding: 6px 8px;
            border: 1px solid #ccc;
        }
        .summary-table .label {
            font-weight: bold;
            background-color: #f9f9f9;
        }

        /* QR Code Centered */
        .qr-code {
            display: block;
            clear: both;
            text-align: center;
            margin-top: 50px;
            padding-top: 50px;
        }
        .qr-code img {
            width: 180px;
            height: 180px;
        }
        .no-qr {
            color: red;
            font-style: italic;
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Header -->
        <div class="header">
            <div>
                <h2>অর্ডার ফর্ম</h2>
            </div>
            <div class="order-info">
                <div><strong>অর্ডার নম্বর:</strong> {{ $order->unique_order_id }}</div>
                <div><strong>তারিখ:</strong> {{ $order->created_at->format('d M Y, h:i A') }}</div>
            </div>
        </div>

        <!-- Buyer Info -->
        <div class="section">
            <div class="section-title">ক্রেতার তথ্য</div>
            <table class="info-table">
                <tr><td class="label">নাম:</td><td>{{ $order->name }}</td></tr>
                <tr><td class="label">ফোন:</td><td>{{ $order->phone }}</td></tr>
                <tr><td class="label">ডেলিভারি ঠিকানা:</td><td>{{ $order->delivery_address }}</td></tr>
                <tr><td class="label">ডেলিভারি এরিয়া:</td><td>{{ $order->delivery_area }}</td></tr>
            </table>
        </div>

        <!-- Items -->
        <div class="section">
            <div class="section-title">অর্ডারকৃত পণ্যসমূহ</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>পণ্যের নাম</th>
                        <th>পরিমাণ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Order Summary -->
        <div class="section">
            <div class="section-title">অর্ডার সারাংশ</div>
            <table class="summary-table">
                <tr>
                    <td class="label">সাবটোটাল</td>
                    <td>{{ number_format($order->subtotal, 2) }} টাকা</td>
                </tr>
                <tr>
                    <td class="label">ডেলিভারি চার্জ</td>
                    <td>{{ number_format($order->delivery_charge, 2) }} টাকা</td>
                </tr>
                <tr>
                    <td class="label">মোট</td>
                    <td><strong>{{ number_format($order->total, 2) }} টাকা</strong></td>
                </tr>
                <tr>
                    <td class="label">অর্ডার নোট</td>
                    <td>{{ $order->order_note ?? 'N/A' }}</td>
                </tr>
            </table>
        </div>

        <!-- QR Code -->
        @if($qrCodePath && file_exists($qrCodePath))
            <div class="qr-code">
                <img src="file:///{{ str_replace('\\', '/', $qrCodePath) }}" alt="QR Code">
            </div>
        @else
            <div class="no-qr">QR কোড পাওয়া যায়নি।</div>
        @endif

    </div>
</body>
</html>
