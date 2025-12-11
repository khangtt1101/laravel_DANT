<x-auth-modern-layout>
    @section('title', 'Xác minh Email')

    <div
        class="glass-card shadow-2xl rounded-2xl overflow-hidden p-8 animate-fade-in relative z-10 w-full transform hover:scale-[1.01] transition-transform duration-300">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 font-display">Xác minh Email</h2>
            <div class="text-sm text-gray-600 dark:text-gray-300">
                {{ __('Cảm ơn bạn đã đăng ký! Trước khi bắt đầu, vui lòng xác minh địa chỉ email của bạn bằng cách nhấp vào liên kết chúng tôi vừa gửi qua email cho bạn.') }}
            </div>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div
                class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 text-center bg-green-50 dark:bg-green-900/30 p-2 rounded-lg border border-green-200 dark:border-green-800">
                {{ __('Một liên kết xác minh mới đã được gửi đến địa chỉ email bạn đã cung cấp.') }}
            </div>
        @endif

        <div class="mt-6 space-y-4">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit"
                    class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-700 hover:to-violet-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:-translate-y-0.5 transition-all duration-200">
                    {{ __('Gửi lại Email xác minh') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full text-center text-sm text-gray-600 dark:text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors py-2">
                    {{ __('Đăng xuất') }}
                </button>
            </form>
        </div>
    </div>
</x-auth-modern-layout>