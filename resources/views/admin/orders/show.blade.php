<x-admin-layout>
    @section('header')
        Chi tiết đơn hàng
    @endsection

    <div class="max-w-5xl mx-auto space-y-6">
        <!-- Header Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.orders.index') }}" class="p-2 bg-white border border-slate-200 rounded-xl text-slate-500 hover:text-indigo-600 hover:border-indigo-200 transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Đơn hàng #{{ $order->order_code }}</h1>
                    <p class="text-sm text-slate-500 mt-1">Đặt lúc: {{ $order->created_at->format('H:i, d/m/Y') }}</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.orders.exportPdf', $order) }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-xl font-medium text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors shadow-sm">
                    <svg class="w-5 h-5 mr-2 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Xuất PDF
                </a>
                <div class="relative">
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="relative" title="{{ in_array($order->status, ['delivered', 'cancelled']) ? 'Đơn hàng đã hoàn tất/hủy, không thể thay đổi' : '' }}">
                            <select name="status" onchange="this.form.submit()" 
                                    {{ in_array($order->status, ['delivered', 'cancelled']) ? 'disabled' : '' }}
                                    class="appearance-none pl-4 pr-10 py-2 bg-indigo-600 border border-transparent rounded-xl font-medium text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 {{ in_array($order->status, ['delivered', 'cancelled']) ? 'cursor-not-allowed opacity-75' : 'cursor-pointer' }}">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Đã giao</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                            @if(!in_array($order->status, ['delivered', 'cancelled']))
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-white">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content: Order Items -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Order Items -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-lg font-bold text-slate-800">Sản phẩm</h2>
                    </div>
                    <div class="p-6">
                        <ul class="divide-y divide-slate-100">
                            @foreach($order->items as $item)
                            <li class="flex py-4 first:pt-0 last:pb-0">
                                <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl border border-slate-200 bg-slate-50">
                                    <img src="{{ Storage::url($item->product->images->first()->image_url ?? '') }}" alt="{{ $item->product->name ?? 'Product' }}" class="h-full w-full object-cover object-center">
                                </div>
                                <div class="ml-4 flex flex-1 flex-col">
                                    <div>
                                        <div class="flex justify-between text-base font-medium text-slate-900">
                                            <h3>{{ $item->product->name ?? 'Sản phẩm đã xóa' }}</h3>
                                            <p class="ml-4">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</p>
                                        </div>
                                        <p class="mt-1 text-sm text-slate-500">Đơn giá: {{ number_format($item->price, 0, ',', '.') }} đ</p>
                                    </div>
                                    <div class="flex flex-1 items-end justify-between text-sm">
                                        <p class="text-slate-500">Số lượng: x{{ $item->quantity }}</p>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="bg-slate-50 p-6 border-t border-slate-100">
                        <div class="flex justify-between text-base font-medium text-slate-900">
                            <p>Tổng tiền thanh toán</p>
                            <p class="text-xl text-indigo-600 font-bold">{{ number_format($order->total_amount, 0, ',', '.') }} đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar: Customer & Info -->
            <div class="space-y-6">
                <!-- Customer Info -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-lg font-bold text-slate-800">Khách hàng</h2>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold border border-indigo-200">
                                {{ substr($order->user->full_name ?? 'K', 0, 1) }}
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-slate-900">{{ $order->user->full_name ?? 'Khách vãng lai' }}</p>
                                <p class="text-xs text-slate-500">{{ $order->user->email ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="border-t border-slate-100 pt-4">
                            <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Thông tin liên hệ</h3>
                            <div class="flex items-start text-sm text-slate-600 mb-2">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $order->phone_number ?? 'Chưa cập nhật' }}
                            </div>
                            <div class="flex items-start text-sm text-slate-600">
                                <svg class="w-4 h-4 mr-2 mt-0.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                {{ $order->shipping_address }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Info -->
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                        <h2 class="text-lg font-bold text-slate-800">Thanh toán</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm text-slate-500">Phương thức</span>
                            <span class="text-sm font-medium text-slate-900 uppercase">{{ $order->payment_method }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-500">Trạng thái</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                Đã thanh toán
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>