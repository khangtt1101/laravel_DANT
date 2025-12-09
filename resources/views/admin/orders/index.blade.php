<x-admin-layout>
    @section('header')
        Quản lý Đơn hàng
    @endsection

    <div class="space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Danh sách đơn hàng</h1>
                <p class="text-sm text-slate-500 mt-1">Theo dõi và xử lý các đơn đặt hàng từ khách hàng.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl relative flex items-center shadow-sm"
                role="alert">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Filters & Search -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <form method="GET" action="{{ route('admin.orders.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out"
                        placeholder="Tìm theo Mã ĐH hoặc Tên sản phẩm...">
                </div>

                <div class="sm:w-48">
                    <select name="status" onchange="this.form.submit()"
                        class="block w-full pl-3 pr-10 py-2.5 text-base border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 sm:text-sm rounded-xl bg-slate-50">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Đang xử lý
                        </option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Đang giao</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Đã giao
                        </option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>
            </form>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Mã Đơn</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Khách hàng</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Tổng tiền</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Trạng thái</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Ngày đặt</th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Hành động</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse ($orders as $order)
                            <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-bold text-indigo-600">#{{ $order->order_code }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold mr-3">
                                            {{ substr($order->user->full_name ?? 'K', 0, 1) }}
                                        </div>
                                        <div class="text-sm font-medium text-slate-900">
                                            {{ $order->user->full_name ?? 'Khách vãng lai' }}
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700">
                                    {{ number_format($order->total_amount, 0, ',', '.') }} đ
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-amber-50 text-amber-700 border-amber-100',
                                            'processing' => 'bg-blue-50 text-blue-700 border-blue-100',
                                            'shipped' => 'bg-indigo-50 text-indigo-700 border-indigo-100',
                                            'delivered' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
                                            'cancelled' => 'bg-rose-50 text-rose-700 border-rose-100',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Chờ xử lý',
                                            'processing' => 'Đang xử lý',
                                            'shipped' => 'Đang giao',
                                            'delivered' => 'Đã giao',
                                            'cancelled' => 'Đã hủy',
                                        ];
                                    @endphp
                                    <form action="{{ route('admin.orders.update', $order) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('PUT')
                                        <div class="relative"
                                            title="{{ in_array($order->status, ['delivered', 'cancelled']) ? 'Đơn hàng đã hoàn tất/hủy, không thể thay đổi' : '' }}">
                                            <select name="status"
                                                onchange="if(confirm('Bạn có chắc chắn muốn thay đổi trạng thái đơn hàng #{{ $order->order_code }}?')) { this.form.submit() } else { this.value = '{{ $order->status }}' }"
                                                {{ in_array($order->status, ['delivered', 'cancelled']) ? 'disabled' : '' }}
                                                class="appearance-none {{ in_array($order->status, ['delivered', 'cancelled']) ? 'cursor-not-allowed opacity-75' : 'cursor-pointer' }} pl-3 pr-8 py-1 rounded-full text-xs font-medium border-0 ring-1 ring-inset focus:ring-2 focus:ring-indigo-600 {{ $statusClasses[$order->status] ?? 'bg-slate-50 text-slate-700 ring-slate-200' }}">
                                                @foreach($statusLabels as $key => $label)
                                                    <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}
                                                        class="bg-white text-slate-900">
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if(!in_array($order->status, ['delivered', 'cancelled']))
                                                <div
                                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                                                    <svg class="h-3 w-3 opacity-60" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                        class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors font-semibold text-xs uppercase tracking-wide">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                            </path>
                                        </svg>
                                        <p class="text-base font-medium text-slate-900">Không tìm thấy đơn hàng nào</p>
                                        <p class="text-sm mt-1">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="bg-white px-4 py-3 border-t border-slate-100 sm:px-6">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>