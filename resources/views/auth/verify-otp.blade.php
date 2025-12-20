<x-auth-modern-layout>
    @section('title', 'Xác thực OTP')

    <div
        class="glass-card shadow-2xl rounded-2xl overflow-hidden p-8 animate-fade-in relative z-10 w-full transform hover:scale-[1.01] transition-transform duration-300">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 font-display">Xác thực OTP</h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 max-w-sm mx-auto">
                {{ __('Một mã xác nhận đã được gửi đến email của bạn. Vui lòng nhập mã để tiếp tục.') }}
            </p>
        </div>

        @if (session('status'))
            <div
                class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-center bg-green-50 dark:bg-green-900/30 p-2 rounded-lg border border-green-200 dark:border-green-800">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('otp.verify') }}" class="space-y-6">
            @csrf

            <!-- Email Address (Hidden) -->
            <input type="hidden" name="email" value="{{ session('email') ?? request('email') }}">

            <!-- OTP Code -->
            <div>
                <x-input-label for="otp" :value="__('Mã OTP')"
                    class="text-gray-700 dark:text-gray-200 font-medium ml-1 mb-1" />
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <x-text-input id="otp"
                        class="block w-full pl-10 py-3 rounded-xl border-gray-300 dark:border-gray-600 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 shadow-sm transition-all duration-300 hover:border-indigo-400 tracking-widest text-center text-lg font-bold"
                        type="text" name="otp" :value="old('otp')" required autofocus autocomplete="one-time-code"
                        placeholder="123456" maxlength="6" />
                </div>
                <x-input-error :messages="$errors->get('otp')" class="mt-2" />
            </div>

            <div class="pt-2">
                <button type="submit"
                    class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:-translate-y-0.5 transition-all duration-200">
                    {{ __('Xác nhận') }}
                </button>
            </div>

            <div class="text-center mt-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                        {{ __('Hủy bỏ & Đăng xuất') }}
                    </button>
                </form>
            </div>
        </form>

        <script>
            document.querySelector('form[action="{{ route('otp.verify') }}"]').addEventListener('submit', function (e) {
                e.preventDefault();

                const form = this;
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalBtnText = submitBtn.innerText;
                const otpInput = form.querySelector('input[name="otp"]');
                const errorContainer = form.querySelector('.text-red-600'); // Assuming x-input-error uses this class

                // Disable button and show loading state
                submitBtn.disabled = true;
                submitBtn.innerText = 'Đang xử lý...';

                // Clear previous errors
                if (errorContainer) {
                    errorContainer.innerText = '';
                    errorContainer.style.display = 'none';
                }
                const existingError = form.querySelector('#otp-error');
                if (existingError) existingError.remove();


                fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        email: form.querySelector('input[name="email"]').value,
                        otp: otpInput.value
                    })
                })
                    .then(response => response.json().then(data => ({ status: response.status, body: data })))
                    .then(({ status, body }) => {
                        if (status === 200) {
                            window.location.href = body.redirect;
                        } else if (status === 422) {
                            // Show error
                            let message = body.message;
                            if (body.errors && body.errors.otp) {
                                message = body.errors.otp[0];
                            }

                            // Create error element if not exists or use existing structure
                            // Using a simple insertion for now tailored to the x-input-error component structure
                            const errorDiv = document.createElement('p');
                            errorDiv.id = 'otp-error';
                            errorDiv.className = 'text-sm text-red-600 dark:text-red-400 mt-2 space-y-1';
                            errorDiv.innerText = message;

                            otpInput.closest('div').parentNode.appendChild(errorDiv);
                        } else {
                            alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Lỗi kết nối. Vui lòng thử lại.');
                    })
                    .finally(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerText = originalBtnText;
                    });
            });
        </script>
    </div>
</x-auth-modern-layout>