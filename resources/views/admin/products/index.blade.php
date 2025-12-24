<x-admin-layout>
    @section('header')
        Quản lý Sản phẩm
    @endsection

    <div class="space-y-6">
        <!-- Header & Actions -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Danh sách sản phẩm</h1>
                <p class="text-sm text-slate-500 mt-1">Quản lý kho hàng và thông tin sản phẩm.</p>
            </div>
            <a href="{{ route('admin.products.create') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-sm text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Thêm sản phẩm
            </a>
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
            <form method="GET" action="{{ route('admin.products.index') }}" class="flex flex-col sm:flex-row gap-4">
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
                        placeholder="Tìm kiếm sản phẩm...">
                </div>

                <div class="sm:w-48">
                    <select name="category" onchange="this.form.submit()"
                        class="block w-full pl-3 pr-10 py-2.5 text-base border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 sm:text-sm rounded-xl bg-slate-50">
                        <option value="">Tất cả danh mục</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="sm:w-48">
                    <select name="stock_status" onchange="this.form.submit()"
                        class="block w-full pl-3 pr-10 py-2.5 text-base border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 sm:text-sm rounded-xl bg-slate-50">
                        <option value="">Tất cả kho hàng</option>
                        <option value="in_stock" {{ request('stock_status') == 'in_stock' ? 'selected' : '' }}>Còn hàng
                            (>10)</option>
                        <option value="low_stock" {{ request('stock_status') == 'low_stock' ? 'selected' : '' }}>Sắp hết
                            (1-10)</option>
                        <option value="out_of_stock" {{ request('stock_status') == 'out_of_stock' ? 'selected' : '' }}>Hết
                            hàng (0)</option>
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
                                Sản phẩm</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Danh mục</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Giá</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Kho</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                Trạng thái</th>
                            <th scope="col" class="relative px-6 py-4">
                                <span class="sr-only">Hành động</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse ($products as $product)
                            <tr class="hover:bg-slate-50/80 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                                            <img class="h-full w-full object-cover object-center"
                                                src="{{ $product->images->first() ? Storage::url($product->images->first()->image_url) : 'https://via.placeholder.com/150' }}"
                                                alt="{{ $product->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-slate-900">{{ $product->name }}</div>
                                            <div class="text-xs text-slate-500">SKU: {{ $product->sku ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-100 text-slate-800">
                                        {{ $product->category->name ?? 'Chưa phân loại' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-slate-700">
                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->stock_quantity > 10)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800 border border-emerald-200">
                                            Còn hàng ({{ $product->stock_quantity }})
                                        </span>
                                    @elseif($product->stock_quantity > 0)
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">
                                            Sắp hết ({{ $product->stock_quantity }})
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800 border border-rose-200">
                                            Hết hàng
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="{{ $product->id }}" class="sr-only peer toggle-status"
                                            {{ $product->is_active ? 'checked' : '' }}>
                                        <div
                                            class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600">
                                        </div>
                                    </label>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}"
                                            class="text-indigo-600 hover:text-indigo-900 p-2 hover:bg-indigo-50 rounded-lg transition-colors"
                                            title="Chỉnh sửa">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>

                                        {{-- <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                            class="inline-block"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-rose-600 hover:text-rose-900 p-2 hover:bg-rose-50 rounded-lg transition-colors"
                                                title="Xóa">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form> --}}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                        </svg>
                                        <p class="text-base font-medium text-slate-900">Không tìm thấy sản phẩm nào</p>
                                        <p class="text-sm mt-1">Thử thay đổi bộ lọc hoặc từ khóa tìm kiếm.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($products->hasPages())
                <div class="bg-white px-4 py-3 border-t border-slate-100 sm:px-6">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const toggles = document.querySelectorAll('.toggle-status');

                toggles.forEach(toggle => {
                    toggle.addEventListener('change', function () {
                        const productId = this.value;
                        const isActive = this.checked;
                        const url = `{{ route('admin.products.toggle-status', ':id') }}`.replace(':id', productId);

                        fetch(url, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Optional: Show toast notification
                                    console.log(data.message);
                                } else {
                                    alert('Có lỗi xảy ra. Vui lòng thử lại.');
                                    this.checked = !isActive; // Revert change
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Có lỗi xảy ra. Vui lòng thử lại.');
                                this.checked = !isActive; // Revert change
                            });
                    });
                });
            });
        </script>
    @endpush
</x-admin-layout>