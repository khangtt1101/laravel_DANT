# PHÂN CHIA CÔNG VIỆC ĐỒ ÁN TỐT NGHIỆP - POLYTECH STORE
## Dự án: Hệ thống E-commerce Laravel

---

## 📋 TỔNG QUAN DỰ ÁN

**Dự án:** Website bán hàng điện tử PolyTech Store  
**Công nghệ:** Laravel 10, MySQL, VNPay, Alpine.js, Tailwind CSS  
**Số thành viên:** 5 người

---

## 👥 PHÂN CHIA CÔNG VIỆC CHO 5 THÀNH VIÊN

### 🟢 **THÀNH VIÊN 1: Authentication & User Management**
**Trách nhiệm chính:**
- ✅ Hệ thống đăng nhập/đăng ký với OTP email
- ✅ Xác thực OTP (OTP Verification)
- ✅ Quản lý Profile người dùng
- ✅ Quản lý địa chỉ giao hàng (UserAddress)
- ✅ Middleware authentication & authorization
- ✅ Password reset/forgot password

**Files liên quan:**
- `app/Http/Controllers/Auth/*` (tất cả controllers)
- `app/Http/Controllers/ProfileController.php`
- `app/Http/Controllers/UserAddressController.php`
- `app/Mail/OtpMail.php`
- `resources/views/auth/*`
- `resources/views/profile/*`
- `app/Models/User.php`
- `database/migrations/*_create_users_table.php`
- `database/migrations/*_add_otp_to_users_table.php`

**Kỹ năng cần:**
- Laravel Authentication
- Email/SMTP configuration
- Session management
- Form validation

**Thời gian ước tính:** 2-3 tuần

---

### 🔵 **THÀNH VIÊN 2: Product Management & Shopping**
**Trách nhiệm chính:**
- ✅ Quản lý sản phẩm (Admin): CRUD sản phẩm
- ✅ Quản lý danh mục (Categories) - Admin
- ✅ Trang Shop: Hiển thị sản phẩm, lọc, tìm kiếm
- ✅ Trang chi tiết sản phẩm
- ✅ Upload và quản lý hình ảnh sản phẩm
- ✅ Trang chủ (Homepage) - hiển thị sản phẩm nổi bật
- ✅ Tracking số người đang xem sản phẩm

**Files liên quan:**
- `app/Http/Controllers/Admin/ProductController.php`
- `app/Http/Controllers/Admin/CategoryController.php`
- `app/Http/Controllers/ShopController.php`
- `app/Http/Controllers/HomeController.php`
- `app/Http/Controllers/ProductViewController.php`
- `app/Models/Product.php`
- `app/Models/Category.php`
- `app/Models/ProductImage.php`
- `resources/views/admin/products/*`
- `resources/views/admin/categories/*`
- `resources/views/shop.blade.php`
- `resources/views/product-detail.blade.php`
- `resources/views/welcome.blade.php`

**Kỹ năng cần:**
- CRUD operations
- File upload/storage
- Eloquent relationships
- Pagination, filtering, search
- Real-time tracking (Session/Cache)

**Thời gian ước tính:** 3-4 tuần

---

### 🟡 **THÀNH VIÊN 3: Shopping Cart & Checkout**
**Trách nhiệm chính:**
- ✅ Giỏ hàng (Cart): Thêm, sửa, xóa sản phẩm
- ✅ Áp dụng Voucher/Giảm giá
- ✅ Trang Checkout
- ✅ Tích hợp thanh toán VNPay
- ✅ Xử lý callback từ VNPay
- ✅ Tạo đơn hàng (Order)
- ✅ Email xác nhận đơn hàng

**Files liên quan:**
- `app/Http/Controllers/CartController.php`
- `app/Http/Controllers/CheckoutController.php`
- `app/Models/Order.php`
- `app/Models/OrderItem.php`
- `app/Models/Voucher.php`
- `app/Models/VoucherUsage.php`
- `app/Mail/OrderPlaced.php`
- `resources/views/cart/*`
- `resources/views/checkout/*`
- `resources/views/emails/order-placed.blade.php`

**Kỹ năng cần:**
- Session management
- Payment gateway integration (VNPay)
- Database transactions
- Email sending
- Voucher logic & validation

**Thời gian ước tính:** 3-4 tuần

---

### 🟣 **THÀNH VIÊN 4: Order Management & Voucher System**
**Trách nhiệm chính:**
- ✅ Quản lý đơn hàng (Admin): Xem, cập nhật trạng thái, xóa
- ✅ Lịch sử đơn hàng (User)
- ✅ Hủy đơn hàng
- ✅ Xuất PDF đơn hàng
- ✅ Hệ thống Voucher: Tạo, quản lý voucher (Admin)
- ✅ Trang khuyến mãi (Promotions)
- ✅ Validation và áp dụng voucher

**Files liên quan:**
- `app/Http/Controllers/Admin/OrderController.php`
- `app/Http/Controllers/Admin/VoucherController.php`
- `app/Http/Controllers/AccountController.php`
- `app/Http/Controllers/PromotionController.php`
- `app/Models/Order.php`
- `app/Models/Voucher.php`
- `app/Models/VoucherUsage.php`
- `resources/views/admin/orders/*`
- `resources/views/admin/vouchers/*`
- `resources/views/account/orders/*`
- `resources/views/pages/promotions.blade.php`

**Kỹ năng cần:**
- Order status workflow
- PDF generation (DomPDF/TCPDF)
- Complex business logic (voucher validation)
- Admin dashboard features

**Thời gian ước tính:** 3-4 tuần

---

### 🟠 **THÀNH VIÊN 5: Review System & Admin Dashboard**
**Trách nhiệm chính:**
- ✅ Hệ thống đánh giá sản phẩm (Review & Rating)
- ✅ Quản lý review (Admin): Xem, xóa review
- ✅ Dashboard Admin: Thống kê, biểu đồ
- ✅ Quản lý người dùng (Admin)
- ✅ Trang liên hệ (Contact)
- ✅ Hỗ trợ khách hàng

**Files liên quan:**
- `app/Http/Controllers/ProductReviewController.php`
- `app/Http/Controllers/Admin/ReviewController.php`
- `app/Http/Controllers/Admin/DashboardController.php`
- `app/Http/Controllers/Admin/UserController.php`
- `app/Http/Controllers/ContactController.php`
- `app/Http/Controllers/AccountController.php` (support method)
- `app/Models/Review.php`
- `app/Models/ContactRequest.php`
- `resources/views/admin/dashboard.blade.php`
- `resources/views/admin/reviews/*`
- `resources/views/admin/users/*`
- `resources/views/pages/contact.blade.php`
- `resources/views/account/support.blade.php`

**Kỹ năng cần:**
- Review/Rating system
- Data visualization (Charts.js/Chart.js)
- Statistics & analytics
- User management

**Thời gian ước tính:** 2-3 tuần

---

## 📊 BẢNG PHÂN CÔNG CHI TIẾT

| Thành viên | Module chính | Controller chính | Model chính | View chính |
|------------|--------------|------------------|-------------|------------|
| **TV1** | Auth & User | Auth/*, ProfileController, UserAddressController | User, UserAddress | auth/*, profile/* |
| **TV2** | Product & Shop | ProductController, CategoryController, ShopController, HomeController | Product, Category, ProductImage | admin/products/*, shop.blade.php |
| **TV3** | Cart & Checkout | CartController, CheckoutController | Order, OrderItem, Voucher | cart/*, checkout/* |
| **TV4** | Order & Voucher | OrderController, VoucherController, AccountController, PromotionController | Order, Voucher, VoucherUsage | admin/orders/*, promotions.blade.php |
| **TV5** | Review & Dashboard | ReviewController, DashboardController, UserController, ContactController | Review, ContactRequest | admin/dashboard.blade.php, admin/reviews/* |

---

## 🔄 QUY TRÌNH LÀM VIỆC

### 1. **Setup chung (Tuần 1)**
- Tất cả thành viên: Clone repo, setup môi trường
- Phân chia database migrations
- Tạo branch riêng cho từng người
- Setup Git workflow

### 2. **Phát triển song song (Tuần 2-6)**
- Mỗi người làm trên branch riêng
- Daily standup để sync
- Code review trước khi merge
- Test integration thường xuyên

### 3. **Tích hợp & Testing (Tuần 7-8)**
- Merge tất cả branches
- Fix conflicts
- Integration testing
- Bug fixing

### 4. **Hoàn thiện (Tuần 9-10)**
- UI/UX polish
- Performance optimization
- Documentation
- Chuẩn bị bảo vệ

---

## ⚠️ LƯU Ý QUAN TRỌNG

### **Các file dùng chung (cần cẩn thận khi merge):**
- `routes/web.php` - Tất cả routes
- `app/Models/*` - Có thể có relationships
- `database/migrations/*` - Cần sync thứ tự
- `resources/views/layouts/*` - Layout chung
- `.env` - Config chung

### **Quy tắc Git:**
- ✅ Mỗi người làm trên branch riêng: `feature/tv1-auth`, `feature/tv2-product`, etc.
- ✅ Commit message rõ ràng: `[TV1] Add OTP verification`
- ✅ Pull trước khi push
- ✅ Tạo Pull Request để review trước khi merge vào main

### **Database:**
- ✅ Tạo migration theo thứ tự
- ✅ Không xóa migration đã chạy
- ✅ Test migration trên local trước

### **Code Style:**
- ✅ Follow PSR-12 coding standards
- ✅ Comment code phức tạp
- ✅ Đặt tên biến/function rõ ràng

---

## 📝 CHECKLIST HOÀN THÀNH

### TV1 - Auth & User
- [ ] Đăng nhập/Đăng ký
- [ ] OTP verification
- [ ] Profile management
- [ ] Address management
- [ ] Password reset

### TV2 - Product & Shop
- [ ] CRUD sản phẩm (Admin)
- [ ] CRUD danh mục (Admin)
- [ ] Trang shop với filter/search
- [ ] Trang chi tiết sản phẩm
- [ ] Homepage
- [ ] Product view tracking

### TV3 - Cart & Checkout
- [ ] Giỏ hàng (thêm/sửa/xóa)
- [ ] Voucher validation
- [ ] Checkout page
- [ ] VNPay integration
- [ ] Order creation
- [ ] Order confirmation email

### TV4 - Order & Voucher
- [ ] Admin order management
- [ ] User order history
- [ ] Order cancellation
- [ ] PDF export
- [ ] Voucher CRUD (Admin)
- [ ] Promotions page

### TV5 - Review & Dashboard
- [ ] Product review system
- [ ] Admin review management
- [ ] Admin dashboard với stats
- [ ] User management (Admin)
- [ ] Contact page
- [ ] Support page

---

## 🎯 KẾT QUẢ MONG ĐỢI

Sau khi hoàn thành, mỗi thành viên sẽ:
- ✅ Hiểu rõ module mình phụ trách
- ✅ Có thể demo và giải thích code
- ✅ Biết cách tích hợp với các module khác
- ✅ Sẵn sàng bảo vệ đồ án

---

## 📞 LIÊN HỆ & HỖ TRỢ

Nếu có vấn đề trong quá trình làm việc:
1. Tạo issue trên Git
2. Họp nhóm để thảo luận
3. Code review lẫn nhau
4. Test integration thường xuyên

**Chúc các bạn thành công! 🚀**

