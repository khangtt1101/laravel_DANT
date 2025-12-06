# 📚 Giải Thích Chi Tiết: Cách Hoạt Động Đăng Ký & Đăng Nhập

## 🔐 PHẦN 1: ĐĂNG KÝ (REGISTRATION)

### **Bước 1: User truy cập trang đăng ký**

```
URL: GET /register
Route: routes/auth.php (dòng 15)
Controller: RegisteredUserController@create
Middleware: 'guest' (chỉ cho phép user chưa đăng nhập)
```

**Luồng xử lý:**
1. Laravel kiểm tra middleware `guest`:
   - ✅ Nếu user **chưa đăng nhập** → Cho phép truy cập
   - ❌ Nếu user **đã đăng nhập** → Redirect về trang chủ

2. Controller trả về view `auth.register` (form đăng ký)

---

### **Bước 2: User điền form và submit**

```
Form gửi: POST /register
Route: routes/auth.php (dòng 18)
Controller: RegisteredUserController@store
```

**Dữ liệu gửi lên:**
- `name`: Tên người dùng
- `email`: Email (phải unique)
- `password`: Mật khẩu
- `password_confirmation`: Xác nhận mật khẩu
- `_token`: CSRF token (tự động thêm bởi `@csrf`)

---

### **Bước 3: Validation (Kiểm tra dữ liệu)**

```php
// File: app/Http/Controllers/Auth/RegisteredUserController.php (dòng 32-36)

$request->validate([
    'name' => ['required', 'string', 'max:255'],
    // ✅ Bắt buộc, là chuỗi, tối đa 255 ký tự
    
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
    // ✅ Bắt buộc, là email hợp lệ, chuyển thành chữ thường, PHẢI UNIQUE trong bảng users
    
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
    // ✅ Bắt buộc, phải khớp với password_confirmation
    // ✅ Rules\Password::defaults() = tối thiểu 8 ký tự
]);
```

**Nếu validation FAIL:**
- Laravel tự động redirect về trang đăng ký
- Hiển thị lỗi trong view qua `$errors`
- Giữ lại dữ liệu cũ qua `old('name')`, `old('email')`

**Nếu validation PASS:**
- Tiếp tục bước 4

---

### **Bước 4: Tạo User mới**

```php
// File: app/Http/Controllers/Auth/RegisteredUserController.php (dòng 38-42)

$user = User::create([
    'full_name' => $request->name,        // Lưu tên vào cột full_name
    'email' => $request->email,            // Email đã được lowercase
    'password' => Hash::make($request->password),  // Mã hóa password bằng bcrypt
]);
```

**Chi tiết:**
- `Hash::make()`: Mã hóa password bằng thuật toán **bcrypt**
  - Ví dụ: `"123456"` → `"$2y$10$abcdefghijklmnopqrstuvwxyz1234567890"`
  - **KHÔNG THỂ** giải mã ngược lại
  - Khi đăng nhập, Laravel so sánh bằng `Hash::check()`

- Database tự động set:
  - `role` = `'customer'` (từ migration default)
  - `email_verified_at` = `NULL` (chưa verify)
  - `created_at`, `updated_at` = thời gian hiện tại

---

### **Bước 5: Gửi Email Verification**

```php
// File: app/Http/Controllers/Auth/RegisteredUserController.php (dòng 44)

event(new Registered($user));
```

**Event này làm gì?**
- Laravel tự động gửi email xác thực đến địa chỉ email của user
- Email chứa link: `/verify-email/{id}/{hash}`
- User click link → Email được verify

---

### **Bước 6: Tự động đăng nhập**

```php
// File: app/Http/Controllers/Auth/RegisteredUserController.php (dòng 46)

Auth::login($user);
```

**Laravel làm gì:**
1. Tạo session cho user
2. Lưu `user_id` vào session
3. User đã được "đăng nhập" ngay sau khi đăng ký

---

### **Bước 7: Redirect**

```php
// File: app/Http/Controllers/Auth/RegisteredUserController.php (dòng 50)

return redirect()->route('home')->with('status', 'Đăng ký thành công!...');
```

**Redirect đến:**
- Route `home` (trang chủ)
- Kèm thông báo success trong session

**Tại sao không redirect đến `dashboard`?**
- Route `dashboard` có middleware `verified` (yêu cầu verify email)
- User mới chưa verify email → sẽ bị chặn
- Nên redirect về `home` để user có thể tiếp tục sử dụng

---

## 🔑 PHẦN 2: ĐĂNG NHẬP (LOGIN)

### **Bước 1: User truy cập trang đăng nhập**

```
URL: GET /login
Route: routes/auth.php (dòng 20)
Controller: AuthenticatedSessionController@create
Middleware: 'guest'
```

**Tương tự như đăng ký:**
- Chỉ cho phép user chưa đăng nhập
- Trả về view `auth.login`

---

### **Bước 2: User điền form và submit**

```
Form gửi: POST /login
Route: routes/auth.php (dòng 23)
Controller: AuthenticatedSessionController@store
Request: LoginRequest (FormRequest)
```

**Dữ liệu gửi lên:**
- `email`: Email đăng nhập
- `password`: Mật khẩu
- `remember`: Checkbox "Remember me" (optional)
- `_token`: CSRF token

---

### **Bước 3: Validation cơ bản**

```php
// File: app/Http/Requests/Auth/LoginRequest.php (dòng 27-33)

public function rules(): array
{
    return [
        'email' => ['required', 'string', 'email'],
        // ✅ Bắt buộc, phải là email hợp lệ
        
        'password' => ['required', 'string'],
        // ✅ Bắt buộc, là chuỗi
    ];
}
```

**Validation này chỉ kiểm tra:**
- Email có đúng format không?
- Password có điền không?
- **KHÔNG** kiểm tra email/password có đúng trong database (sẽ kiểm tra ở bước sau)

---

### **Bước 4: Rate Limiting (Giới hạn số lần thử)**

```php
// File: app/Http/Requests/Auth/LoginRequest.php (dòng 42, 60-76)

$this->ensureIsNotRateLimited();
```

**Cách hoạt động:**
1. Tạo "throttle key" từ email + IP:
   ```php
   $key = "user@example.com|192.168.1.1"
   ```

2. Kiểm tra số lần thử:
   - Nếu đã thử **≥ 5 lần** trong 1 phút → **KHÓA** tài khoản
   - Hiển thị: "Too many login attempts. Please try again in X seconds."

3. Mục đích: **Chống brute force attack**

**Ví dụ:**
- Lần 1-4: Cho phép thử
- Lần 5: Vẫn cho phép, nhưng nếu sai → khóa
- Lần 6: Bị khóa, phải đợi 60 giây

---

### **Bước 5: Xác thực (Authentication)**

```php
// File: app/Http/Requests/Auth/LoginRequest.php (dòng 44)

if (! Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
    // Đăng nhập THẤT BẠI
    RateLimiter::hit($this->throttleKey());  // Tăng số lần thử sai
    throw ValidationException::withMessages([
        'email' => trans('auth.failed'),  // "These credentials do not match our records."
    ]);
}
```

**`Auth::attempt()` làm gì?**

1. Tìm user trong database:
   ```sql
   SELECT * FROM users WHERE email = 'user@example.com'
   ```

2. So sánh password:
   ```php
   Hash::check($inputPassword, $user->password)
   // So sánh password người dùng nhập với password đã hash trong DB
   ```

3. Nếu **ĐÚNG**:
   - Tạo session
   - Lưu `user_id` vào session
   - Nếu có `remember` → Tạo cookie "remember me" (30 ngày)

4. Nếu **SAI**:
   - Tăng số lần thử sai (rate limiting)
   - Throw exception với message lỗi

---

### **Bước 6: Xóa Rate Limit (Nếu đăng nhập thành công)**

```php
// File: app/Http/Requests/Auth/LoginRequest.php (dòng 52)

RateLimiter::clear($this->throttleKey());
```

**Mục đích:** Reset số lần thử sai về 0

---

### **Bước 7: Regenerate Session**

```php
// File: app/Http/Controllers/Auth/AuthenticatedSessionController.php (dòng 29)

$request->session()->regenerate();
```

**Tại sao cần regenerate?**
- **Bảo mật**: Tránh session fixation attack
- Tạo session ID mới, vô hiệu hóa session ID cũ

---

### **Bước 8: Phân quyền và Redirect**

```php
// File: app/Http/Controllers/Auth/AuthenticatedSessionController.php (dòng 34-40)

if ($request->user()->role === 'admin') {
    // Nếu là ADMIN
    return redirect()->route('admin.dashboard');
}

// Nếu là USER thường
return redirect()->intended(route('dashboard'));
```

**Giải thích:**
- `$request->user()`: Lấy thông tin user đã đăng nhập từ session
- Kiểm tra `role`:
  - `'admin'` → Redirect đến `/admin/dashboard`
  - `'customer'` → Redirect đến `/home` (dashboard)

**`redirect()->intended()` là gì?**
- Nếu user bị chặn bởi middleware `auth` và redirect về `/login`
- Sau khi đăng nhập, Laravel tự động redirect về trang ban đầu user muốn truy cập
- Ví dụ: User muốn vào `/account/orders` → Bị chặn → Đăng nhập → Tự động vào `/account/orders`

---

## 🚪 PHẦN 3: ĐĂNG XUẤT (LOGOUT)

### **Luồng xử lý:**

```php
// File: app/Http/Controllers/Auth/AuthenticatedSessionController.php (dòng 46-54)

public function destroy(Request $request): RedirectResponse
{
    // 1. Xóa session đăng nhập
    Auth::guard('web')->logout();
    
    // 2. Xóa toàn bộ session
    $request->session()->invalidate();
    
    // 3. Tạo CSRF token mới
    $request->session()->regenerateToken();
    
    // 4. Redirect về trang chủ
    return redirect('/');
}
```

**Chi tiết:**
1. `Auth::logout()`: Xóa thông tin user khỏi session
2. `session()->invalidate()`: Xóa toàn bộ dữ liệu trong session
3. `regenerateToken()`: Tạo CSRF token mới (bảo mật)
4. Redirect về `/`

---

## 🔒 PHẦN 4: BẢO MẬT

### **1. CSRF Protection**

**Mọi form đều có:**
```blade
@csrf
```

**Cách hoạt động:**
- Laravel tạo token ngẫu nhiên
- Lưu trong session
- Gửi kèm form dưới dạng `_token`
- Khi submit, Laravel so sánh token
- Nếu không khớp → **TỪ CHỐI** request

**Mục đích:** Chống CSRF attack (Cross-Site Request Forgery)

---

### **2. Password Hashing**

**Không bao giờ lưu password dạng plain text:**
```php
// ❌ SAI
'password' => $request->password  // "123456"

// ✅ ĐÚNG
'password' => Hash::make($request->password)  // "$2y$10$..."
```

**Khi đăng nhập:**
```php
// Laravel tự động so sánh
Auth::attempt(['email' => $email, 'password' => $password])
// → Hash::check($password, $user->password)
```

---

### **3. Rate Limiting**

**Giới hạn 5 lần thử trong 1 phút:**
```php
if (RateLimiter::tooManyAttempts($key, 5)) {
    // Khóa tài khoản
}
```

**Mục đích:** Chống brute force attack

---

### **4. Session Security**

**Sau khi đăng nhập:**
```php
$request->session()->regenerate();
```

**Sau khi đăng xuất:**
```php
$request->session()->invalidate();
$request->session()->regenerateToken();
```

**Mục đích:** Tránh session hijacking

---

### **5. Middleware Protection**

**Routes được bảo vệ:**
```php
// Chỉ cho phép user chưa đăng nhập
Route::middleware('guest')->group(function () {
    Route::get('login', ...);
    Route::get('register', ...);
});

// Chỉ cho phép user đã đăng nhập
Route::middleware('auth')->group(function () {
    Route::get('dashboard', ...);
});
```

---

## 📊 SƠ ĐỒ LUỒNG XỬ LÝ

### **Đăng Ký:**
```
User → GET /register → Form đăng ký
     ↓
User điền form → POST /register
     ↓
Validation → Tạo User → Hash password
     ↓
Gửi email verify → Auto login → Redirect home
```

### **Đăng Nhập:**
```
User → GET /login → Form đăng nhập
     ↓
User điền form → POST /login
     ↓
Validation → Rate limiting check
     ↓
Auth::attempt() → So sánh email/password
     ↓
Nếu đúng → Regenerate session → Check role → Redirect
Nếu sai → Tăng rate limit → Hiển thị lỗi
```

---

## 🎯 TÓM TẮT

### **Đăng Ký:**
1. ✅ Validation dữ liệu
2. ✅ Hash password
3. ✅ Tạo user trong database
4. ✅ Gửi email verification
5. ✅ Auto login
6. ✅ Redirect về home

### **Đăng Nhập:**
1. ✅ Validation cơ bản
2. ✅ Rate limiting (5 lần/phút)
3. ✅ Xác thực email/password
4. ✅ Regenerate session
5. ✅ Phân quyền (admin/user)
6. ✅ Redirect theo role

### **Bảo Mật:**
- ✅ CSRF protection
- ✅ Password hashing (bcrypt)
- ✅ Rate limiting
- ✅ Session security
- ✅ Middleware protection

---

**Hy vọng giải thích này giúp bạn hiểu rõ cách hoạt động! 🚀**


