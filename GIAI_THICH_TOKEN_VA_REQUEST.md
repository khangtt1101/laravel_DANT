# 🔐 Giải Thích Chi Tiết: Token & Request Handling trong Đăng Ký/Đăng Nhập

## 📋 TỔNG QUAN

Hệ thống đăng ký/đăng nhập sử dụng **4 loại token chính**:
1. **CSRF Token** - Bảo vệ chống CSRF attack
2. **Session Token** - Quản lý phiên đăng nhập
3. **Remember Me Token** - Lưu đăng nhập lâu dài
4. **Email Verification Token** - Xác thực email (signed URL)

---

## 🛡️ 1. CSRF TOKEN (Cross-Site Request Forgery Protection)

### **Cách hoạt động:**

#### **A. Trong Form (Frontend):**

```blade
<!-- File: resources/views/auth/login.blade.php (dòng 6) -->
<form method="POST" action="{{ route('login') }}">
    @csrf  <!-- ← Tạo CSRF token -->
    
    <input type="email" name="email">
    <input type="password" name="password">
    <button type="submit">Đăng nhập</button>
</form>
```

**`@csrf` làm gì?**
- Tạo một token ngẫu nhiên (ví dụ: `abc123xyz789`)
- Lưu token vào **session**
- Tạo input ẩn trong form:
  ```html
  <input type="hidden" name="_token" value="abc123xyz789">
  ```

#### **B. Khi Submit (Backend):**

```php
// Laravel tự động kiểm tra CSRF token
// File: app/Http/Middleware/VerifyCsrfToken.php (tự động chạy)

// 1. Lấy token từ request
$requestToken = $request->input('_token');

// 2. Lấy token từ session
$sessionToken = session()->token();

// 3. So sánh
if ($requestToken !== $sessionToken) {
    // ❌ Token không khớp → TỪ CHỐI request
    throw new \Illuminate\Session\TokenMismatchException();
}

// ✅ Token khớp → Cho phép request tiếp tục
```

#### **C. Regenerate Token (Sau logout):**

```php
// File: app/Http/Controllers/Auth/AuthenticatedSessionController.php (dòng 52)

public function destroy(Request $request): RedirectResponse
{
    Auth::logout();
    $request->session()->invalidate();
    
    // Tạo CSRF token MỚI sau khi logout
    $request->session()->regenerateToken();
    
    return redirect('/');
}
```

**Tại sao regenerate?**
- **Bảo mật**: Token cũ không thể tái sử dụng
- **Chống replay attack**: Token chỉ dùng 1 lần

---

## 🎫 2. SESSION TOKEN (Quản lý phiên đăng nhập)

### **Cách hoạt động:**

#### **A. Khi đăng nhập thành công:**

```php
// File: app/Http/Requests/Auth/LoginRequest.php (dòng 44)

Auth::attempt($this->only('email', 'password'), $this->boolean('remember'));
```

**Laravel làm gì bên trong:**

1. **Tìm user trong database:**
   ```sql
   SELECT * FROM users WHERE email = 'user@example.com'
   ```

2. **So sánh password:**
   ```php
   Hash::check($inputPassword, $user->password)
   ```

3. **Nếu đúng → Tạo session:**
   ```php
   // Laravel tự động:
   session()->put('_token', 'new-session-token-123');
   session()->put('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d', $user->id);
   //                                                                    ↑
   //                                                    User ID được lưu trong session
   ```

4. **Lưu session vào:**
   - **Database** (nếu `SESSION_DRIVER=database`)
   - **File** (nếu `SESSION_DRIVER=file`)
   - **Cookie** (nếu `SESSION_DRIVER=cookie`)

#### **B. Regenerate Session (Sau đăng nhập):**

```php
// File: app/Http/Controllers/Auth/AuthenticatedSessionController.php (dòng 29)

$request->session()->regenerate();
```

**Tại sao regenerate?**
- **Bảo mật**: Tránh session fixation attack
- **Tạo session ID mới**: Session cũ bị vô hiệu hóa

**Ví dụ:**
```
Trước: session_id = "abc123"
Sau:   session_id = "xyz789"  ← Mới, an toàn hơn
```

#### **C. Kiểm tra đăng nhập (Middleware):**

```php
// File: app/Http/Middleware/Authenticate.php (tự động chạy)

Route::middleware('auth')->group(function () {
    // Chỉ cho phép user đã đăng nhập
});
```

**Laravel làm gì:**
```php
// 1. Lấy user_id từ session
$userId = session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');

// 2. Tìm user trong database
$user = User::find($userId);

// 3. Nếu không tìm thấy → Redirect về /login
if (!$user) {
    return redirect()->route('login');
}

// 4. Nếu tìm thấy → Cho phép truy cập
$request->setUserResolver(function () use ($user) {
    return $user;
});
```

---

## 🍪 3. REMEMBER ME TOKEN (Lưu đăng nhập lâu dài)

### **Cách hoạt động:**

#### **A. Trong Form:**

```blade
<!-- File: resources/views/auth/login.blade.php (dòng 30) -->
<input id="remember_me" type="checkbox" name="remember">
```

#### **B. Khi đăng nhập với "Remember Me":**

```php
// File: app/Http/Requests/Auth/LoginRequest.php (dòng 44)

Auth::attempt(
    $this->only('email', 'password'),
    $this->boolean('remember')  // ← true nếu checkbox được chọn
);
```

**Laravel làm gì:**

1. **Tạo remember token:**
   ```php
   $rememberToken = Str::random(60);  // Ví dụ: "abc123xyz789..."
   
   // Lưu vào database
   $user->remember_token = $rememberToken;
   $user->save();
   ```

2. **Tạo cookie "remember_web_...":**
   ```php
   // Cookie chứa:
   // - user_id
   // - remember_token
   // - Expires: 30 ngày (hoặc theo config)
   
   setcookie(
       'remember_web_59ba36addc2b2f9401580f014c7f58ea4e30989d',
       $userId . '|' . $rememberToken,
       time() + (30 * 24 * 60 * 60),  // 30 ngày
       '/',
       null,
       true,  // HttpOnly
       true   // Secure (nếu HTTPS)
   );
   ```

#### **C. Khi user quay lại (Session đã hết hạn):**

```php
// Laravel tự động kiểm tra cookie "remember_me"

// 1. Lấy cookie
$cookie = $request->cookie('remember_web_...');

// 2. Tách user_id và token
[$userId, $rememberToken] = explode('|', $cookie);

// 3. Tìm user và so sánh token
$user = User::find($userId);
if ($user && $user->remember_token === $rememberToken) {
    // ✅ Token khớp → Tự động đăng nhập lại
    Auth::login($user);
}
```

#### **D. Khi logout:**

```php
// File: app/Http/Controllers/Auth/AuthenticatedSessionController.php (dòng 48)

Auth::guard('web')->logout();

// Laravel tự động:
// 1. Xóa remember_token trong database
// 2. Xóa cookie "remember_me"
```

---

## ✉️ 4. EMAIL VERIFICATION TOKEN (Signed URL)

### **Cách hoạt động:**

#### **A. Khi đăng ký:**

```php
// File: app/Http/Controllers/Auth/RegisteredUserController.php (dòng 44)

event(new Registered($user));
```

**Event này trigger email verification:**

```php
// Laravel tự động gửi email với link:
$verificationUrl = URL::temporarySignedRoute(
    'verification.verify',
    now()->addMinutes(60),  // Hết hạn sau 60 phút
    [
        'id' => $user->id,
        'hash' => sha1($user->email)  // Hash email để verify
    ]
);

// URL ví dụ:
// http://127.0.0.1:8000/verify-email/1/abc123?signature=xyz789&expires=1234567890
//                                                      ↑
//                                          Signed signature (bảo mật)
```

#### **B. Signed URL là gì?**

**Signed URL** = URL có chữ ký số để:
- ✅ Xác thực URL không bị giả mạo
- ✅ Có thời gian hết hạn
- ✅ Không thể tái sử dụng sau khi hết hạn

**Cách tạo:**
```php
// 1. Tạo signature từ:
$signature = hash_hmac(
    'sha256',
    $url . $expires,
    config('app.key')  // APP_KEY trong .env
);

// 2. Thêm vào URL:
$url .= "?signature={$signature}&expires={$expires}";
```

#### **C. Khi user click link:**

```php
// File: app/Http/Controllers/Auth/VerifyEmailController.php (dòng 15)

// Route có middleware 'signed'
Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1']);
```

**Middleware 'signed' làm gì:**
```php
// 1. Lấy signature từ URL
$signature = $request->query('signature');
$expires = $request->query('expires');

// 2. Tạo lại signature từ URL hiện tại
$expectedSignature = hash_hmac('sha256', $url . $expires, config('app.key'));

// 3. So sánh
if ($signature !== $expectedSignature) {
    // ❌ Signature không khớp → URL bị giả mạo
    abort(403, 'Invalid signature');
}

// 4. Kiểm tra hết hạn
if (now()->timestamp > $expires) {
    // ❌ URL đã hết hạn
    abort(403, 'Link expired');
}

// ✅ Signature hợp lệ và chưa hết hạn
```

**Sau đó verify email:**
```php
// File: app/Http/Controllers/Auth/VerifyEmailController.php (dòng 21)

if ($request->user()->markEmailAsVerified()) {
    // Cập nhật: email_verified_at = now()
    event(new Verified($request->user()));
}
```

---

## 📨 5. REQUEST HANDLING (Xử lý Request)

### **A. Request Validation:**

#### **Đăng ký:**
```php
// File: app/Http/Controllers/Auth/RegisteredUserController.php (dòng 32-36)

$request->validate([
    'name' => ['required', 'string', 'max:255'],
    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
]);
```

**Các bước xử lý:**
1. **Sanitize dữ liệu:**
   - `lowercase`: Chuyển email thành chữ thường
   - `string`: Loại bỏ HTML tags
   - `max:255`: Giới hạn độ dài

2. **Validation:**
   - `required`: Bắt buộc phải có
   - `email`: Phải đúng format email
   - `unique:users`: Email không được trùng
   - `confirmed`: Password phải khớp với password_confirmation

3. **Nếu FAIL:**
   ```php
   // Laravel tự động:
   // - Redirect về trang trước
   // - Giữ lại dữ liệu cũ (old('name'), old('email'))
   // - Hiển thị lỗi trong $errors
   return back()->withErrors($validator);
   ```

#### **Đăng nhập:**
```php
// File: app/Http/Requests/Auth/LoginRequest.php (dòng 27-33)

public function rules(): array
{
    return [
        'email' => ['required', 'string', 'email'],
        'password' => ['required', 'string'],
    ];
}
```

**FormRequest tự động:**
- Validate dữ liệu trước khi vào controller
- Nếu FAIL → Throw `ValidationException`
- Nếu PASS → Tiếp tục vào method `authenticate()`

---

### **B. Rate Limiting (Giới hạn số lần thử):**

```php
// File: app/Http/Requests/Auth/LoginRequest.php (dòng 42, 60-76)

$this->ensureIsNotRateLimited();
```

**Cách hoạt động:**

1. **Tạo throttle key:**
   ```php
   $key = Str::transliterate(
       Str::lower($email) . '|' . $request->ip()
   );
   // Ví dụ: "user@example.com|192.168.1.1"
   ```

2. **Kiểm tra số lần thử:**
   ```php
   if (RateLimiter::tooManyAttempts($key, 5)) {
       // Đã thử ≥ 5 lần → KHÓA
       $seconds = RateLimiter::availableIn($key);
       throw ValidationException::withMessages([
           'email' => "Too many attempts. Try again in {$seconds} seconds."
       ]);
   }
   ```

3. **Tăng số lần thử (nếu đăng nhập sai):**
   ```php
   if (!Auth::attempt(...)) {
       RateLimiter::hit($key);  // Tăng số lần thử
       throw ValidationException::withMessages([
           'email' => 'These credentials do not match our records.'
       ]);
   }
   ```

4. **Xóa rate limit (nếu đăng nhập thành công):**
   ```php
   RateLimiter::clear($key);  // Reset về 0
   ```

---

### **C. Request Sanitization (Làm sạch dữ liệu):**

#### **Email:**
```php
// File: app/Http/Controllers/Auth/RegisteredUserController.php (dòng 34)

'email' => ['required', 'string', 'lowercase', 'email', ...]
//                              ↑
//                    Tự động chuyển thành chữ thường
```

**Ví dụ:**
```
Input:  "User@EXAMPLE.COM"
Output: "user@example.com"
```

#### **Password:**
```php
// File: app/Http/Controllers/Auth/RegisteredUserController.php (dòng 41)

'password' => Hash::make($request->password)
//                    ↑
//          Mã hóa password (không lưu plain text)
```

**Ví dụ:**
```
Input:  "123456"
Output: "$2y$10$abcdefghijklmnopqrstuvwxyz1234567890"
```

---

## 🔄 6. LUỒNG XỬ LÝ HOÀN CHỈNH

### **Đăng Ký:**

```
1. User submit form
   ↓
2. Laravel kiểm tra CSRF token
   ↓
3. Validation dữ liệu (name, email, password)
   ↓
4. Sanitize email (lowercase)
   ↓
5. Hash password (bcrypt)
   ↓
6. Tạo user trong database
   ↓
7. Gửi email verification (signed URL)
   ↓
8. Tạo session (auto login)
   ↓
9. Regenerate session token
   ↓
10. Redirect về home
```

### **Đăng Nhập:**

```
1. User submit form
   ↓
2. Laravel kiểm tra CSRF token
   ↓
3. Validation cơ bản (email, password)
   ↓
4. Rate limiting check (≤ 5 lần/phút)
   ↓
5. Auth::attempt() → So sánh email/password
   ↓
6. Nếu đúng:
   - Tạo session (lưu user_id)
   - Nếu có "remember me" → Tạo remember token + cookie
   - Regenerate session
   - Clear rate limit
   ↓
7. Phân quyền (admin/user) → Redirect
```

---

## 🎯 TÓM TẮT

### **Token được sử dụng:**

| Token | Mục đích | Lưu ở đâu | Thời gian hết hạn |
|-------|----------|-----------|-------------------|
| **CSRF Token** | Chống CSRF attack | Session | Mỗi request mới |
| **Session Token** | Quản lý phiên đăng nhập | Session/Cookie | 120 phút (mặc định) |
| **Remember Me Token** | Lưu đăng nhập lâu dài | Database + Cookie | 30 ngày |
| **Email Verification Token** | Xác thực email | Signed URL | 60 phút |

### **Request được xử lý:**

1. ✅ **CSRF Protection** - Mọi form đều có `@csrf`
2. ✅ **Validation** - Kiểm tra dữ liệu đầu vào
3. ✅ **Sanitization** - Làm sạch dữ liệu (lowercase, trim, etc.)
4. ✅ **Rate Limiting** - Giới hạn 5 lần thử/phút
5. ✅ **Password Hashing** - Mã hóa bằng bcrypt
6. ✅ **Session Security** - Regenerate sau login/logout
7. ✅ **Signed URL** - Email verification an toàn

---

**Tất cả các token và request đều được Laravel xử lý tự động và an toàn! 🔒**


