<x-main-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-8 text-center">
            <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Đặt hàng thành công!</h1>
            <p class="text-gray-600 mb-6">Cảm ơn bạn đã mua hàng. Mã đơn hàng của bạn là:</p>
            <p class="text-3xl font-bold text-indigo-600 mb-8">
                {{ $order->order_code ?? '#' . $order->id }}
            </p>
            <a href="{{ route('shop.index') }}" class="inline-block bg-indigo-600 text-white font-medium py-3 px-8 rounded-md shadow-md hover:bg-indigo-700">
                Tiếp tục mua sắm
            </a>
        </div>
    </div>
</x-main-layout>