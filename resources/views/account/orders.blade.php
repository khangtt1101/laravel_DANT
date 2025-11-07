<x-account-layout>
    <h2 class="text-2xl font-semibold text-gray-900 mb-6">
        Lịch sử đơn hàng
    </h2>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mã ĐH</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ngày đặt</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tổng tiền</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Trạng thái</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $order->order_code ?? "#".$order->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 font-medium">{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-indigo-600">{{ ucfirst($order->status) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-medium">
                           
                            <a href="{{ route('account.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">
                                Xem chi tiết
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">Bạn chưa có đơn hàng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</x-account-layout>