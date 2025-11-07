<x-account-layout>
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">
        Tổng quan
    </h2>
    
    <div class="space-y-8">
        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Đơn hàng gần đây</h3>
            @forelse($recentOrders as $order)
                <div class="border rounded-md p-4 mb-4">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-800">Mã đơn: {{ $order->order_code ?? "#".$order->id }}</span>
                        <span class="text-sm text-gray-500">{{ $order->created_at->format('d/m/Y') }}</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-2">Trạng thái: 
                        <span class="font-medium text-indigo-600">{{ ucfirst($order->status) }}</span>
                    </p>
                    <p class="text-sm text-gray-600">Tổng tiền: 
                        <span class="font-medium text-gray-800">{{ number_format($order->total_amount, 0, ',', '.') }} đ</span>
                    </p>
                </div>
            @empty
                <p class="text-gray-500">Bạn chưa có đơn hàng nào gần đây.</p>
            @endforelse
        </div>

        <div>
            <h3 class="text-lg font-medium text-gray-900 mb-4">Voucher của bạn</h3>
            <div class="border rounded-md p-4 text-center">
                <p class="text-gray-500">Bạn chưa có voucher nào.</p>
            </div>
        </div>
    </div>
</x-account-layout>