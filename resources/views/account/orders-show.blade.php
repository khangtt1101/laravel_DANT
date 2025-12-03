<x-account-layout>
    <div class="mb-6">
        <a href="{{ route('account.orders') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
            &larr; Quay lại Lịch sử đơn hàng
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 text-red-600 px-4 py-3">
            {{ session('error') }}
        </div>
    @endif

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
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                <div>
                    <h3 class="font-medium text-gray-900 mb-2">Trạng thái</h3>
                    <p class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                        @class([
                            'bg-yellow-100 text-yellow-800' => $order->status === 'pending',
                            'bg-blue-100 text-blue-700' => $order->status === 'processing',
                            'bg-green-100 text-green-700' => $order->status === 'completed',
                            'bg-red-100 text-red-700' => $order->status === 'cancelled',
                            'bg-gray-100 text-gray-700' => !in_array($order->status, ['pending','processing','completed','cancelled']),
                        ])">
                        {{ ucfirst($order->status) }}
                    </p>
                </div>

                @if(in_array($order->status, ['pending', 'processing']))
                    <form action="{{ route('account.orders.cancel', $order) }}" method="POST"
                        onsubmit="return confirm('Bạn chắc chắn muốn huỷ đơn hàng này?');">
                        @csrf
                        <button type="submit"
                            class="w-full px-4 py-2 text-sm font-semibold text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                            Huỷ đơn hàng
                        </button>
                    </form>
                @endif
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