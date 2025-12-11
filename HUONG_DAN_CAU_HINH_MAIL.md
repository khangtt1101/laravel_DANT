# 📧 Hướng Dẫn Cấu Hình Mail Thật

## 🚀 CÁCH 1: Gmail SMTP (Khuyến nghị - Dễ nhất)

### **Bước 1: Tạo App Password cho Gmail**

1. Vào: https://myaccount.google.com/
2. Bật **2-Step Verification** (nếu chưa bật)
3. Vào **Security** → **2-Step Verification** → **App passwords**
4. Tạo App Password mới:
   - Select app: **Mail**
   - Select device: **Other (Custom name)** → Nhập "Laravel"
   - Click **Generate**
   - Copy password (16 ký tự, ví dụ: `abcd efgh ijkl mnop`)

### **Bước 2: Cấu hình trong `.env`**

Mở file `.env` và thêm/sửa các dòng sau:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=abcd efgh ijkl mnop
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="PolyTech Store"
```

**Lưu ý:**
- `MAIL_USERNAME`: Email Gmail của bạn
- `MAIL_PASSWORD`: App Password vừa tạo (bỏ khoảng trắng: `abcdefghijklmnop`)
- `MAIL_FROM_ADDRESS`: Cùng email với MAIL_USERNAME

### **Bước 3: Clear config cache**

```bash
php artisan config:clear
```

---

## 🧪 CÁCH 2: Mailtrap (Cho Development - Không cần setup phức tạp)

### **Bước 1: Đăng ký Mailtrap**

1. Vào: https://mailtrap.io/
2. Đăng ký tài khoản miễn phí
3. Vào **Email Testing** → **Inboxes** → Chọn inbox mặc định
4. Copy thông tin SMTP:
   - Host: `sandbox.smtp.mailtrap.io`
   - Port: `2525`
   - Username: (từ Mailtrap)
   - Password: (từ Mailtrap)

### **Bước 2: Cấu hình trong `.env`**

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@polytech.vn
MAIL_FROM_NAME="PolyTech Store"
```

**Lưu ý:** Mailtrap chỉ lưu email để test, không gửi email thật.

---

## ✅ KIỂM TRA

Sau khi cấu hình:

1. **Clear config cache:**
   ```bash
   php artisan config:clear
   ```

2. **Test gửi email:**
   - Vào `/forgot-password`
   - Nhập email
   - Submit form
   - Kiểm tra email inbox (hoặc Mailtrap inbox)

---

## 🔧 TROUBLESHOOTING

### **Lỗi: "Connection could not be established"**

- Kiểm tra `MAIL_HOST` và `MAIL_PORT` đúng chưa
- Kiểm tra firewall có chặn port 587 không

### **Lỗi: "Authentication failed"**

- Kiểm tra `MAIL_USERNAME` và `MAIL_PASSWORD` đúng chưa
- Với Gmail: Đảm bảo đã dùng App Password (không phải password thường)

### **Email không đến**

- Kiểm tra spam folder
- Với Gmail: Có thể bị delay vài phút
- Với Mailtrap: Kiểm tra trong Mailtrap inbox (không gửi email thật)

---

## 📝 TÓM TẮT

**Gmail SMTP:**
- ✅ Gửi email thật
- ✅ Miễn phí
- ⚠️ Cần App Password

**Mailtrap:**
- ✅ Dễ setup
- ✅ Không cần App Password
- ❌ Chỉ test, không gửi email thật

**Khuyến nghị:** Dùng **Gmail** cho production, **Mailtrap** cho development.


