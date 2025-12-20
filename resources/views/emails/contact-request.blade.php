<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Yêu cầu hỗ trợ mới</title>
</head>

<body style="font-family: Arial, sans-serif; background-color:#f8fafc; padding:24px; color:#0f172a;">
    <table width="100%" cellpadding="0" cellspacing="0"
        style="max-width:640px;margin:0 auto;background:#ffffff;border-radius:12px;padding:32px;border:1px solid #e2e8f0;">
        <tr>
            <td>
                <h2 style="margin-top:0;margin-bottom:16px;color:#1d4ed8;">Thông tin yêu cầu hỗ trợ</h2>
                <p style="margin:0 0 12px 0;">Bạn nhận được một yêu cầu mới từ website CellphoneS.</p>

                <div style="margin-bottom:24px;">
                    <p style="margin:6px 0;"><strong>Họ tên:</strong> {{ $contactRequest->full_name }}</p>
                    <p style="margin:6px 0;"><strong>Email:</strong> {{ $contactRequest->email }}</p>
                    @if(!empty($contactRequest->phone))
                        <p style="margin:6px 0;"><strong>Số điện thoại:</strong> {{ $contactRequest->phone }}</p>
                    @endif
                    <p style="margin:6px 0;"><strong>Mã yêu cầu:</strong> #{{ $contactRequest->id }}</p>
                    <p style="margin:6px 0;"><strong>Thời gian gửi:</strong>
                        {{ $contactRequest->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <div style="background:#f8fafc;border-radius:10px;padding:16px;border:1px solid #e2e8f0;">
                    <p style="margin-top:0;margin-bottom:8px;font-weight:bold;">Nội dung hỗ trợ:</p>
                    <p style="margin:0;white-space:pre-line;">{{ $contactRequest->message }}</p>
                </div>

                <p style="margin-top:24px;font-size:12px;color:#64748b;">Email được gửi tự động từ hệ thống. Vui lòng
                    trả lời trực tiếp cho khách hàng qua email ở trên.</p>
            </td>
        </tr>
    </table>
</body>

</html>