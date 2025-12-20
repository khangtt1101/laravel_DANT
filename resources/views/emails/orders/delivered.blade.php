<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đơn hàng đã giao thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #e74c3c;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #e74c3c;
            margin: 0;
            font-size: 24px;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333333;
        }

        .order-info {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .order-info p {
            margin: 5px 0;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #777777;
            margin-top: 30px;
            border-top: 1px solid #eeeeee;
            padding-top: 15px;
        }

        .button {
            display: inline-block;
            background-color: #e74c3c;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Cảm ơn bạn đã mua hàng!</h1>
        </div>
        <div class="content">
            <p>Xin chào <strong>{{ $order->user->name }}</strong>,</p>
            <p>Đơn hàng của bạn với mã số <strong>#{{ $order->order_code }}</strong> đã được giao thành công. Chúng tôi
                hy vọng bạn hài lòng với sản phẩm.</p>

            <div class="order-info">
                <p>Thông tin đơn hàng:</p>
                <p>Mã đơn hàng: #{{ $order->order_code }}</p>
                <p>Tổng tiền: {{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</p>
                <p>Ngày đặt hàng: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <p>Danh sách sản phẩm:</p>
            <ul>
                @foreach($order->items as $item)
                    <li>
                        {{ $item->product ? $item->product->name : 'Sản phẩm đã bị xóa' }}
                        (x{{ $item->quantity }}) - {{ number_format($item->price, 0, ',', '.') }} VNĐ
                    </li>
                @endforeach
            </ul>

            <center>
                <a href="{{ route('home') }}" class="button" style="color: #ffffff;">Tiếp tục mua sắm</a>
            </center>
        </div>
        <div class="footer">
            <p>Đây là email tự động, vui lòng không trả lời email này.</p>
            <p>&copy; {{ date('Y') }} CellphoneS. All rights reserved.</p>
        </div>
    </div>
</body>

</html>