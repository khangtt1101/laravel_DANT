<x-admin-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Chi tiết đơn hàng #{{ $order->id }}
                    </h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                        &larr; Quay lại danh sách
                    </a>
                </div>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Đặt lúc: {{ $order->created_at->format('d/m/Y H:i') }}
                </p>
            </div>
            <div class="border-t border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-6">
                    <div class="md:col-span-1 p-6 border-r border-gray-200">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Thông tin khách hàng</h4>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Tên khách hàng</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $order->user->full_name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $order->user->email }}</dd>
                            </div>
                             <div>
                                <dt class="text-sm font-medium text-gray-500">Địa chỉ giao hàng</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $order->shipping_address }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phương thức thanh toán</dt>
                                <dd class="mt-1 text-sm text-gray-900">{{ $order->payment_method }}</dd>
                            </div>
                        </dl>
                    </div>

                    <div class="md:col-span-2 p-6">
                        <h4 class="text-md font-semibold text-gray-800 mb-4">Các sản phẩm trong đơn</h4>
                        <div class="flow-root">
                            <ul role="list" class="-my-6 divide-y divide-gray-200">
                                @foreach($order->items as $item)
                                <li class="flex py-6">
                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div>
                                            <div class="flex justify-between text-base font-medium text-gray-900">
                                                <h3>{{ $item->product->name ?? 'Sản phẩm đã bị xóa' }}</h3>
                                                <p class="ml-4">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</p>
                                            </div>
                                            <p class="mt-1 text-sm text-gray-500">Đơn giá: {{ number_format($item->price, 0, ',', '.') }} đ</p>
                                        </div>
                                        <div class="flex flex-1 items-end justify-between text-sm">
                                            <p class="text-gray-500">Số lượng: {{ $item->quantity }}</p>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="border-t border-gray-200 mt-6 pt-6">
                            <div class="flex justify-between text-base font-medium text-gray-900">
                                <p>Tổng cộng</p>
                                <p>{{ number_format($order->total_amount, 0, ',', '.') }} đ</p>
                            </div>
                        </div>

                        <div class="mt-8 border-t border-gray-200 pt-6">
                             <h4 class="text-md font-semibold text-gray-800 mb-4">Cập nhật trạng thái đơn hàng</h4>
                             <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="flex items-center space-x-4">
                                    <select name="status" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                        @php
                                            $statuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
                                        @endphp
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" @if($order->status == $status) selected @endif>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                        Cập nhật
                                    </button>
                                </div>
                             </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>