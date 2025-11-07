<x-account-layout>
    <div class="mb-6">
        <a href="{{ route('account.orders') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
            &larr; Quay lại Lịch sử đơn hàng
        </a>
    </div>

    <h2 class="text-2xl font-semibold text-gray-900 mb-2">
        Chi tiết đơn hàng
    </h2>
    <p class="text-lg font-bold text-indigo-600 mb-6">
        Mã đơn: {{ $order->order_code ?? "#".$order->id }}
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="md:col-span-1 space-y-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-medium text-gray-900 mb-2">Thông tin giao hàng</h3>
                <p class="text-sm text-gray-600">{{ Auth::user()->full_name }}</p>
                <p class="text-sm text-gray-600">{{ $order->shipping_address }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-medium text-gray-900 mb-2">Trạng thái</h3>
                <p class="text-sm font-semibold text-indigo-600">{{ ucfirst($order->status) }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-medium text-gray-900 mb-2">Thanh toán</h3>
                <p class="text-sm text-gray-600">{{ $order->payment_method }}</p>
            </div>
        </div>

        <div class="md:col-span-2">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Các sản phẩm đã đặt</h3>
            <ul role="list" class="divide-y divide-gray-200 border-t border-b">
                @foreach($order->items as $item)
                    <li class="py-4 flex">
                        <div class="flex-shrink-0 w-20 h-20 border border-gray-200 rounded-md overflow-hidden">
                            @if($item->product && $item->product->images->first())
                                <img src="{{ Storage::url($item->product->images->first()->image_url) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">(Không ảnh)</div>
                            @endif
                        </div>

                        <div class="ml-4 flex-1 flex flex-col">
                            <div>
                                <h4 class="text-base font-medium text-gray-900">
                                    {{ $item->product->name ?? 'Sản phẩm đã bị xóa' }}
                                </h4>
                                <p class="mt-1 text-sm text-gray-500">{{ number_format($item->price, 0, ',', '.') }} đ / cái</p>
                            </div>
                            <div class="flex-1 flex items-end justify-between text-sm">
                                <p class="text-gray-500">Số lượng: {{ $item->quantity }}</p>
                                <p class="font-medium text-gray-800">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
            <dl class="mt-6 space-y-4 text-right">
                <div class="flex justify-end border-t border-gray-200 pt-4">
                    <dt class="text-base font-bold text-gray-900">TỔNG CỘNG</dt>
                    <dd class="text-base font-bold text-gray-900 ml-4">
                        {{ number_format($order->total_amount, 0, ',', '.') }} đ
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</x-account-layout>