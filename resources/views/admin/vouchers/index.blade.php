<x-admin-layout>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-gray-900">Quản lý Voucher</h1>
                <p class="mt-2 text-sm text-gray-700">Quản lý tất cả mã giảm giá và khuyến mãi.</p>
            </div>
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <a href="{{ route('admin.vouchers.create') }}" class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                    Tạo voucher mới
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mt-4 rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mt-4 rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-8">
            <form method="GET" action="{{ route('admin.vouchers.index') }}">
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <div class="flex-1">
                        <label for="search" class="sr-only">Tìm kiếm</label>
                        <input type="text" name="search" id="search"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                               placeholder="Tìm theo mã hoặc tên voucher..."
                               value="{{ request('search') }}">
                    </div>

                    <div class="w-full md:w-48">
                        <label for="status" class="sr-only">Trạng thái</label>
                        <select id="status" name="status"
                                class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                            <option value="">Tất cả trạng thái</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Chưa kích hoạt</option>
                            <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Đã hết hạn</option>
                        </select>
                    </div>

                    <button type="submit"
                            class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                        Lọc
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Mã</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tên</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Loại</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Giá trị</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Đơn tối thiểu</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Đã dùng</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Thời gian</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Trạng thái</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Thao tác</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($vouchers as $voucher)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                            <code class="px-2 py-1 bg-gray-100 rounded text-indigo-600">{{ $voucher->code }}</code>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $voucher->name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            @if($voucher->type === 'percentage')
                                                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded">Phần trăm</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Cố định</span>
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            @if($voucher->type === 'percentage')
                                                {{ $voucher->value }}%
                                                @if($voucher->max_discount_amount)
                                                    <br><span class="text-xs text-gray-400">(Tối đa: {{ number_format($voucher->max_discount_amount, 0, ',', '.') }} đ)</span>
                                                @endif
                                            @else
                                                {{ number_format($voucher->value, 0, ',', '.') }} đ
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ number_format($voucher->min_order_amount, 0, ',', '.') }} đ
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            {{ $voucher->used_count }}
                                            @if($voucher->usage_limit)
                                                / {{ $voucher->usage_limit }}
                                            @endif
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="text-xs">
                                                <div>Từ: {{ $voucher->start_date->format('d/m/Y') }}</div>
                                                <div>Đến: {{ $voucher->end_date->format('d/m/Y') }}</div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            @php
                                                $now = now();
                                                $isActive = $voucher->is_active && $now->gte($voucher->start_date) && $now->lte($voucher->end_date);
                                                $isExpired = $now->gt($voucher->end_date);
                                            @endphp
                                            @if($isExpired)
                                                <span class="px-2 py-1 text-xs font-medium bg-red-100 text-red-800 rounded">Hết hạn</span>
                                            @elseif($isActive)
                                                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded">Đang hoạt động</span>
                                            @else
                                                <span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded">Chưa kích hoạt</span>
                                            @endif
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('admin.vouchers.edit', $voucher) }}" class="text-indigo-600 hover:text-indigo-900">Sửa</a>
                                            <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" class="inline-block ml-4" onsubmit="return confirm('Bạn có chắc muốn xóa voucher này?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Xóa</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center text-sm text-gray-500">
                                            Không có voucher nào.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $vouchers->links() }}
        </div>
    </div>
</x-admin-layout>

