<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đặt hàng thành công</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f8fafc; padding:24px; color:#0f172a;">
    <table width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;margin:0 auto;background:#ffffff;border-radius:12px;padding:32px;border:1px solid #e2e8f0;">
        <tr>
            <td>
                <h2 style="margin-top:0;margin-bottom:16px;color:#1d4ed8;">Cảm ơn bạn đã đặt hàng!</h2>
                <p style="margin:0 0 12px 0;">Đơn hàng của bạn đã được tiếp nhận thành công. Chúng tôi sẽ xử lý và giao hàng cho bạn trong thời gian sớm nhất.</p>

                <div style="background:#f8fafc;border-radius:10px;padding:20px;border:1px solid #e2e8f0;margin-bottom:24px;">
                    <h3 style="margin-top:0;margin-bottom:16px;color:#1e293b;">Thông tin đơn hàng</h3>
                    <p style="margin:6px 0;"><strong>Mã đơn hàng:</strong> <span style="color:#1d4ed8;font-weight:bold;">#{{ $order->order_code }}</span></p>
                    <p style="margin:6px 0;"><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                    <p style="margin:6px 0;"><strong>Phương thức thanh toán:</strong> 
                        @if($order->payment_method === 'COD')
                            Thanh toán khi nhận hàng (COD)
                        @elseif($order->payment_method === 'MoMo')
                            Ví điện tử MoMo
                        @else
                            {{ $order->payment_method }}
                        @endif
                    </p>
                    <p style="margin:6px 0;"><strong>Địa chỉ giao hàng:</strong> {{ $order->shipping_address }}</p>
                    <p style="margin:6px 0;"><strong>Trạng thái:</strong> 
                        <span style="color:#059669;font-weight:bold;">
                            @if($order->status === 'pending')
                                Đang chờ xử lý
                            @elseif($order->status === 'processing')
                                Đang xử lý
                            @elseif($order->status === 'shipped')
                                Đang giao hàng
                            @elseif($order->status === 'delivered')
                                Đã giao hàng
                            @elseif($order->status === 'cancelled')
                                Đã hủy
                            @else
                                {{ $order->status }}
                            @endif
                        </span>
                    </p>
                </div>

                <div style="margin-bottom:24px;">
                    <h3 style="margin-top:0;margin-bottom:16px;color:#1e293b;">Chi tiết sản phẩm</h3>
                    <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
                        <thead>
                            <tr style="background:#f1f5f9;">
                                <th style="text-align:left;padding:12px;border-bottom:2px solid #e2e8f0;">Sản phẩm</th>
                                <th style="text-align:center;padding:12px;border-bottom:2px solid #e2e8f0;">Số lượng</th>
                                <th style="text-align:right;padding:12px;border-bottom:2px solid #e2e8f0;">Giá</th>
                                <th style="text-align:right;padding:12px;border-bottom:2px solid #e2e8f0;">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td style="padding:12px;border-bottom:1px solid #e2e8f0;">
                                    <strong>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</strong>
                                </td>
                                <td style="text-align:center;padding:12px;border-bottom:1px solid #e2e8f0;">{{ $item->quantity }}</td>
                                <td style="text-align:right;padding:12px;border-bottom:1px solid #e2e8f0;">{{ number_format($item->price, 0, ',', '.') }}đ</td>
                                <td style="text-align:right;padding:12px;border-bottom:1px solid #e2e8f0;"><strong>{{ number_format($item->price * $item->quantity, 0, ',', '.') }}đ</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="background:#f8fafc;border-radius:10px;padding:20px;border:1px solid #e2e8f0;margin-bottom:24px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        @if($order->discount_amount > 0)
                        <tr>
                            <td style="padding:8px 0;"><strong>Tạm tính:</strong></td>
                            <td style="text-align:right;padding:8px 0;">{{ number_format($order->items->sum(function($item) { return $item->price * $item->quantity; }), 0, ',', '.') }}đ</td>
                        </tr>
                        <tr>
                            <td style="padding:8px 0;"><strong>Giảm giá ({{ $order->voucher_code ?? 'Voucher' }}):</strong></td>
                            <td style="text-align:right;padding:8px 0;color:#dc2626;">-{{ number_format($order->discount_amount, 0, ',', '.') }}đ</td>
                        </tr>
                        @endif
                        <tr>
                            <td style="padding:8px 0;font-size:18px;"><strong>Tổng cộng:</strong></td>
                            <td style="text-align:right;padding:8px 0;font-size:18px;color:#1d4ed8;"><strong>{{ number_format($order->total_amount, 0, ',', '.') }}đ</strong></td>
                        </tr>
                    </table>
                </div>

                <div style="background:#eff6ff;border-left:4px solid #1d4ed8;padding:16px;border-radius:8px;margin-bottom:24px;">
                    <p style="margin:0;color:#1e40af;"><strong>Lưu ý:</strong> Bạn có thể theo dõi trạng thái đơn hàng trong tài khoản của mình. Chúng tôi sẽ thông báo cho bạn khi đơn hàng được cập nhật.</p>
                </div>

                <p style="margin-top:24px;font-size:12px;color:#64748b;">Email được gửi tự động từ hệ thống. Nếu có thắc mắc, vui lòng liên hệ với chúng tôi qua email hoặc hotline.</p>
            </td>
        </tr>
    </table>
</body>
</html>



