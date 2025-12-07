<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mã Xác Nhận OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .otp-code {
            font-size: 32px;
            font-weight: bold;
            color: #2d3748;
            text-align: center;
            letter-spacing: 5px;
            margin: 20px 0;
            background: #edf2f7;
            padding: 15px;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #718096;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Xác thực tài khoản của bạn</h2>
        </div>
        <p>Xin chào,</p>
        <p>Cảm ơn bạn đã đăng ký. Vui lòng sử dụng mã OTP dưới đây để hoàn tất việc xác minh tài khoản của bạn:</p>

        <div class="otp-code">
            {{ $otp }}
        </div>

        <p>Mã này sẽ hết hạn trong vòng 10 phút.</p>
        <p>Nếu bạn không yêu cầu mã này, vui lòng bỏ qua email này.</p>

        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        </div>
    </div>
</body>

</html>