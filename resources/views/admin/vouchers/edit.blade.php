<x-admin-layout>
    <div class="bg-white p-8 rounded-md shadow-md">
        <h1 class="text-xl font-semibold text-gray-900">Chỉnh sửa voucher</h1>
        
        <form method="POST" action="{{ route('admin.vouchers.update', $voucher) }}" class="mt-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <!-- Mã voucher -->
                <div>
                    <label for="code" class="block text-sm font-medium text-gray-700">Mã voucher <span class="text-red-500">*</span></label>
                    <input type="text" name="code" id="code" value="{{ old('code', $voucher->code) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="VD: GIAM10">
                    @error('code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tên voucher -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Tên voucher <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $voucher->name) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="VD: Giảm 10% cho đơn hàng">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mô tả -->
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $voucher->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Loại voucher -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Loại giảm giá <span class="text-red-500">*</span></label>
                    <select name="type" id="type" required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                            onchange="updateValueLabel()">
                        <option value="percentage" {{ old('type', $voucher->type) == 'percentage' ? 'selected' : '' }}>Phần trăm (%)</option>
                        <option value="fixed" {{ old('type', $voucher->type) == 'fixed' ? 'selected' : '' }}>Số tiền cố định</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Giá trị -->
                <div>
                    <label for="value" class="block text-sm font-medium text-gray-700">
                        Giá trị <span class="text-red-500">*</span>
                        <span id="value-label" class="text-gray-500 text-xs">(%)</span>
                    </label>
                    <input type="number" name="value" id="value" value="{{ old('value', $voucher->value) }}" step="0.01" min="0" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('value')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Đơn hàng tối thiểu -->
                <div>
                    <label for="min_order_amount" class="block text-sm font-medium text-gray-700">Đơn hàng tối thiểu (VNĐ) <span class="text-red-500">*</span></label>
                    <input type="number" name="min_order_amount" id="min_order_amount" value="{{ old('min_order_amount', $voucher->min_order_amount) }}" step="1000" min="0" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('min_order_amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Giảm giá tối đa (chỉ cho percentage) -->
                <div id="max_discount_container">
                    <label for="max_discount_amount" class="block text-sm font-medium text-gray-700">Giảm giá tối đa (VNĐ)</label>
                    <input type="number" name="max_discount_amount" id="max_discount_amount" value="{{ old('max_discount_amount', $voucher->max_discount_amount) }}" step="1000" min="0"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="Để trống nếu không giới hạn">
                    @error('max_discount_amount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Giới hạn sử dụng -->
                <div>
                    <label for="usage_limit" class="block text-sm font-medium text-gray-700">Giới hạn sử dụng (tổng)</label>
                    <input type="number" name="usage_limit" id="usage_limit" value="{{ old('usage_limit', $voucher->usage_limit) }}" min="0"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="Để trống nếu không giới hạn">
                    @error('usage_limit')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Giới hạn sử dụng mỗi user -->
                <div>
                    <label for="usage_limit_per_user" class="block text-sm font-medium text-gray-700">Giới hạn sử dụng mỗi user</label>
                    <input type="number" name="usage_limit_per_user" id="usage_limit_per_user" value="{{ old('usage_limit_per_user', $voucher->usage_limit_per_user) }}" min="0"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                           placeholder="Để trống nếu không giới hạn">
                    @error('usage_limit_per_user')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ngày bắt đầu -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Ngày bắt đầu <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date', $voucher->start_date->format('Y-m-d\TH:i')) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ngày kết thúc -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700">Ngày kết thúc <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date', $voucher->end_date->format('Y-m-d\TH:i')) }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Danh mục áp dụng -->
                <div class="sm:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Danh mục áp dụng</label>
                    <p class="text-xs text-gray-500 mb-3">Chọn danh mục để voucher chỉ áp dụng cho sản phẩm thuộc danh mục đó. Để trống nếu áp dụng cho tất cả sản phẩm.</p>
                    <div class="border border-gray-300 rounded-md p-4 max-h-60 overflow-y-auto">
                        @php
                            $selectedCategories = old('categories', $voucher->categories->pluck('id')->toArray());
                        @endphp
                        @foreach($categories as $category)
                            <div class="mb-3">
                                <label class="flex items-center">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}" 
                                           {{ in_array($category->id, $selectedCategories) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm font-medium text-gray-900">{{ $category->name }}</span>
                                </label>
                                @if($category->children->isNotEmpty())
                                    <div class="ml-6 mt-1 space-y-1">
                                        @foreach($category->children as $child)
                                            <label class="flex items-center">
                                                <input type="checkbox" name="categories[]" value="{{ $child->id }}"
                                                       {{ in_array($child->id, $selectedCategories) ? 'checked' : '' }}
                                                       class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                <span class="ml-2 text-sm text-gray-700">{{ $child->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    @error('categories')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Trạng thái -->
                <div class="sm:col-span-2">
                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $voucher->is_active) ? 'checked' : '' }}
                               class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">Kích hoạt voucher</label>
                    </div>
                </div>

                <!-- Thông tin sử dụng -->
                <div class="sm:col-span-2">
                    <div class="rounded-md bg-gray-50 p-4">
                        <p class="text-sm text-gray-600">
                            <strong>Đã sử dụng:</strong> {{ $voucher->used_count }} lần
                            @if($voucher->usage_limit)
                                / {{ $voucher->usage_limit }} lần
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <a href="{{ route('admin.vouchers.index') }}" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Hủy
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Cập nhật voucher
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function updateValueLabel() {
            const type = document.getElementById('type').value;
            const valueLabel = document.getElementById('value-label');
            const maxDiscountContainer = document.getElementById('max_discount_container');
            
            if (type === 'percentage') {
                valueLabel.textContent = '(%)';
                maxDiscountContainer.style.display = 'block';
            } else {
                valueLabel.textContent = '(VNĐ)';
                maxDiscountContainer.style.display = 'none';
            }
        }

        // Gọi hàm khi trang load
        document.addEventListener('DOMContentLoaded', function() {
            updateValueLabel();
        });
    </script>
</x-admin-layout>


