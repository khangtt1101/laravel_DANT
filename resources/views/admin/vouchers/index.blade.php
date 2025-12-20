<x-admin-layout>
    @section('header')
        Quản lý Voucher
    @endsection

    <div class="space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Danh sách voucher</h1>
                <p class="text-sm text-slate-500 mt-1">Quản lý mã giảm giá và khuyến mãi.</p>
            </div>
            <a href="{{ route('admin.vouchers.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tạo voucher mới
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl relative flex items-center shadow-sm" role="alert">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative flex items-center shadow-sm" role="alert">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Filters & Search -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-slate-100">
            <form method="GET" action="{{ route('admin.vouchers.index') }}" class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 sm:text-sm transition duration-150 ease-in-out" 
                           placeholder="Tìm kiếm theo mã hoặc tên voucher...">
                </div>
                
                <div class="sm:w-48">
                    <select name="status" onchange="this.form.submit()" 
                            class="block w-full pl-3 pr-10 py-2.5 text-base border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 sm:text-sm rounded-xl bg-slate-50">
                        <option value="">Tất cả trạng thái</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Đang hoạt động</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tạm dừng</option>
                        <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Hết hạn</option>
                    </select>
                </div>

                <button type="submit" class="inline-flex items-center justify-center px-4 py-2.5 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Tìm kiếm
                </button>
            </form>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50/50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Mã voucher</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tên</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Loại</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Giá trị</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Đã dùng</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Ngày hết hạn</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Trạng thái</th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Hành động</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse($vouchers as $voucher)
                        <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-indigo-600">{{ $voucher->code }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-slate-900">{{ $voucher->name }}</div>
                                @if($voucher->description)
                                <div class="text-xs text-slate-500 mt-1">{{ \Illuminate\Support\Str::limit($voucher->description, 50) }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $voucher->type == 'percentage' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ $voucher->type == 'percentage' ? 'Phần trăm' : 'Số tiền' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700">
                                @if($voucher->type == 'percentage')
                                    {{ $voucher->value }}%
                                    @if($voucher->max_discount_amount)
                                        <span class="text-xs text-slate-500 block">Tối đa: {{ number_format($voucher->max_discount_amount, 0, ',', '.') }} đ</span>
                                    @endif
                                @else
                                    {{ number_format($voucher->value, 0, ',', '.') }} đ
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ $voucher->used_count ?? 0 }}
                                @if($voucher->usage_limit)
                                    / {{ $voucher->usage_limit }}
                                @else
                                    / ∞
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}
                                @if(\Carbon\Carbon::parse($voucher->end_date)->isPast())
                                    <span class="text-xs text-red-500 block">Đã hết hạn</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" class="sr-only peer voucher-status-toggle" 
                                               data-id="{{ $voucher->id }}" 
                                               {{ $voucher->is_active ? 'checked' : '' }}>
                                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                        <span class="ml-3 text-sm font-medium text-gray-900 status-label-{{ $voucher->id }}">
                                            {{ $voucher->is_active ? 'Đang hoạt động' : 'Tạm dừng' }}
                                        </span>
                                    </label>
                                </div>
                                @if(\Carbon\Carbon::parse($voucher->end_date)->isPast())
                                    <span class="text-xs text-red-500 block mt-1">Hết hạn</span>
                                @elseif(\Carbon\Carbon::parse($voucher->start_date)->isFuture())
                                    <span class="text-xs text-yellow-600 block mt-1">Chưa bắt đầu</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.vouchers.edit', $voucher) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 transition-colors duration-150" 
                                       title="Chỉnh sửa">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('Bạn có chắc chắn muốn xóa voucher này?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 transition-colors duration-150 {{ $voucher->used_count > 0 ? 'opacity-50 cursor-not-allowed' : '' }}" 
                                                title="Xóa"
                                                {{ $voucher->used_count > 0 ? 'disabled' : '' }}>
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="px-6 py-10 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                    </svg>
                                    <p class="text-base font-medium text-slate-900">Không tìm thấy voucher nào</p>
                                    <p class="text-sm mt-1">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm.</p>
                                    <a href="{{ route('admin.vouchers.create') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors duration-150">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        Tạo voucher đầu tiên
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            @if($vouchers->hasPages())
            <div class="bg-white px-4 py-3 border-t border-slate-100 sm:px-6">
                {{ $vouchers->links() }}
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('.voucher-status-toggle');
        
        toggles.forEach(toggle => {
            toggle.addEventListener('change', function() {
                const voucherId = this.dataset.id;
                const statusLabel = document.querySelector(`.status-label-${voucherId}`);
                
                // Disable to prevent double click
                this.disabled = true;
                
                fetch(`/admin/vouchers/${voucherId}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        statusLabel.textContent = data.is_active ? 'Đang hoạt động' : 'Tạm dừng';
                        // Show success toast (basic alert for now, can be improved)
                        // alert(data.message); 
                    } else {
                        // Revert status if failed
                        this.checked = !this.checked;
                        alert('Có lỗi xảy ra, vui lòng thử lại.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    this.checked = !this.checked;
                    alert('Lỗi kết nối');
                })
                .finally(() => {
                    this.disabled = false;
                });
            });
        });
    });
</script>
