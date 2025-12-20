<!DOCTYPE html>
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Hóa đơn #{{ $order->order_code }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0;
        }

        .info-section {
            margin-bottom: 20px;
            width: 100%;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            vertical-align: top;
            padding: 5px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .total-section {
            text-align: right;
            margin-top: 20px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>HÓA ĐƠN BÁN HÀNG</h1>
        <p>Mã đơn hàng: #{{ $order->order_code }}</p>
        <p>Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="info-section">
        <table class="info-table">
            <tr>
                <td width="50%">
                    <strong>Thông tin khách hàng:</strong><br>
                    Họ tên: {{ $order->user ? $order->user->full_name : 'Khách vãng lai' }}<br>
                    Email: {{ $order->user ? $order->user->email : 'N/A' }}<br>
                    Số điện thoại: {{ $order->phone_number ?? 'N/A' }}<br>
                    Địa chỉ: {{ $order->address ?? 'N/A' }}
                </td>
                <td width="50%">
                    <strong>Thông tin cửa hàng:</strong><br>
                    CellphoneS<br>
                    Địa chỉ: 123 Đường ABC, Quận XYZ, TP.HCM<br>
                    Hotline: 1900 1234<br>
                    Website: www.cellphones.com.vn
                </td>
            </tr>
        </table>
    </div>

    <table class="items-table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th class="text-right">Đơn giá</th>
                <th class="text-right">Số lượng</th>
                <th class="text-right">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->product->name }}</td>
                    <td class="text-right">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                    <td class="text-right">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <p><strong>Tổng tiền hàng:</strong> {{ number_format($order->total_amount, 0, ',', '.') }} đ</p>
        <!-- Nếu có phí vận chuyển hoặc giảm giá, thêm vào đây -->
        <p><strong>Tổng cộng:</strong> <span
                style="font-size: 18px; color: #d32f2f;">{{ number_format($order->total_amount, 0, ',', '.') }} đ</span>
        </p>
    </div>

    <div class="footer">
        <p>Cảm ơn quý khách đã mua hàng tại CellphoneS!</p>
        <p>Vui lòng giữ lại hóa đơn để được bảo hành.</p>
    </div>
</body>

</html>