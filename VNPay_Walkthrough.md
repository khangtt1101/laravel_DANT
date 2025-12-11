# Hướng dẫn Kiểm thử VNPay

Đã hoàn thành tích hợp VNPay. Dưới đây là các bước để kiểm thử:

## Các thay đổi chính
- **CheckoutController**:
    - `vnpayPayment`: Tạo đơn hàng (status: pending) trước khi chuyển hướng sang VNPay.
    - `vnpayReturn`: Xử lý kết quả trả về, cập nhật status đơn hàng thành `processing` nếu thành công.
- **.env**: Đã kiểm tra và xác nhận có cấu hình VNPay.

## Các bước kiểm thử (Manual Verification)

1.  **Chuẩn bị**:
    - Đảm bảo server đang chạy (`php artisan serve`).
    - Đăng nhập vào hệ thống.

2.  **Thực hiện đặt hàng**:
    - Thêm sản phẩm vào giỏ hàng.
    - Vào trang Checkout.
    - Chọn địa chỉ giao hàng.
    - Chọn phương thức thanh toán **VNPay**.
    - Nhấn nút **Đặt hàng**.

3.  **Xác minh chuyển hướng**:
    - Hệ thống sẽ tạo đơn hàng (kiểm tra trong database: `select * from orders order by id desc limit 1;` -> status phải là `pending`).
    - Trình duyệt chuyển hướng sang trang thanh toán Sandbox của VNPay.
    - Số tiền trên VNPay phải khớp với tổng đơn hàng.

4.  **Thanh toán thành công**:
    - Sử dụng thông tin thẻ test (Ngân hàng: NCB, Số thẻ: 9704198526191432198, Tên: NGUYEN VAN A, Ngày PH: 07/15, OTP: 123456).
    - Hoàn tất thanh toán.
    - Hệ thống chuyển hướng về trang `checkout.success`.
    - Kiểm tra database: status đơn hàng chuyển thành `processing`.

5.  **Thanh toán thất bại/Hủy**:
    - Lặp lại bước 2.
    - Tại trang VNPay, chọn **Hủy giao dịch**.
    - Hệ thống chuyển hướng về trang Checkout và báo lỗi.
    - Kiểm tra database: status đơn hàng vẫn là `pending` (hoặc `cancelled` nếu bạn đã sửa logic hủy).

## Lưu ý
- Nếu gặp lỗi "Sai chữ ký" (Invalid Signature), hãy kiểm tra lại `VNP_HASH_SECRET` trong `.env`.
