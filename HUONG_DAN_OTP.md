# Tổng Hợp Tính Năng Xác Thực OTP

Dưới đây là tổng hợp toàn bộ quy trình và các thay đổi đã thực hiện cho tính năng xác thực OTP.

## 1. Quy Trình Hoạt Động (Workflow)

### A. Đăng Ký Tài Khoản Mới (Registration)
Đây là quy trình **Xác thực trước khi Tạo tài khoản**.
1.  **Người dùng**: Điền thông tin vào form Đăng ký (`Register`).
2.  **Hệ thống**:
    *   Kiểm tra hợp lệ (Validate).
    *   **KHÔNG** lưu ngay vào Database.
    *   Lưu tạm thông tin (Tên, Email, Password đã mã hóa, Mã OTP) vào **Session**.
    *   Gửi email chứa mã OTP đến địa chỉ email đăng ký.
    *   Chuyển hướng người dùng đến trang nhập OTP (`/verify-otp`).
3.  **Người dùng**: Kiểm tra email và nhập mã OTP.
4.  **Hệ thống**:
    *   Kiểm tra mã OTP khớp với Session.
    *   Nếu đúng:
        *   Tạo bản ghi người dùng mới vào Database (`users` table).
        *   Đặt trạng thái là **Đã xác thực** (`email_verified_at` = now).
        *   Tự động đăng nhập và chuyển hướng vào Dashboard.
    *   Nếu sai: Báo lỗi và yêu cầu nhập lại.

### B. Đăng Nhập (Login) dành cho tài khoản cũ/chưa xác thực
Quy trình này đảm bảo không có tài khoản chưa xác thực nào lọt vào hệ thống.
1.  **Người dùng**: Đăng nhập bằng Email và Password.
2.  **Hệ thống**:
    *   Xác thực Email/Password đúng.
    *   Kiểm tra trạng thái xác thực (`email_verified_at`).
    *   Nếu **ĐÃ** xác thực: Cho phép truy cập.
    *   Nếu **CHƯA** xác thực:
        *   Đăng xuất ngay lập tức.
        *   Tạo mã OTP mới và cập nhật vào Database (cột `otp`).
        *   Gửi email OTP.
        *   Chuyển hướng đến trang nhập OTP.

## 2. Chi Tiết Kỹ Thuật (Technical Details)

### Cơ Sở Dữ Liệu
*   **Users Table**: Thêm cột `otp` (lưu mã tạm) và `otp_expires_at` (thời gian hết hạn). Dùng cho luồng Đăng nhập (Login flow).

### Các Tệp Tin Chính
*   **Routes** (`routes/auth.php`):
    *   Thêm `GET` & `POST` `/verify-otp`.
*   **Mail** (`app/Mail/OtpMail.php`):
    *   Class gửi mail, truyền biến `$otp` vào view.
    *   Template: `resources/views/emails/auth/otp.blade.php`.
*   **Views**:
    *   Trang nhập mã: `resources/views/auth/verify-otp.blade.php`.
*   **Controllers**:
    *   `RegisteredUserController`: Đã sửa logic `store` để dùng Session thay vì `User::create`.
    *   `OtpVerificationController`:
        *   Xử lý logic kép: Kiểm tra Session (cho đăng ký mới) HOẶC kiểm tra Database (cho user cũ).
        *   Thực hiện `User::create` hoặc `User::save` tương ứng.
    *   `AuthenticatedSessionController`: Thêm logic chặn user chưa verify ở hàm `store`.

## 3. Cách Kiểm Tra (Testing)
1.  **Đăng ký mới**:
    *   Đăng ký -> Nhận mail -> Nhập OTP -> Vào Dashboard -> Kiểm tra DB thấy user mới có `email_verified_at`.
2.  **Đăng nhập user chưa active**:
    *   Login -> Bị đá ra trang OTP -> Nhận mail mới -> Nhập OTP -> Vào Dashboard.

Hệ thống hiện tại đảm bảo tính bảo mật và logic "Không OTP thì không tạo tài khoản".
