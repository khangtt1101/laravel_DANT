@csrf
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Main Info -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Basic Info -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-800">Thông tin cơ bản</h2>
            </div>
            <div class="p-6 space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Tên sản phẩm</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out" 
                           placeholder="Nhập tên sản phẩm..." required>
                    @error('name') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Mô tả chi tiết</label>
                    <textarea id="description" name="description" rows="6" 
                              class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out"
                              placeholder="Mô tả chi tiết về sản phẩm...">{{ old('description', $product->description ?? '') }}</textarea>
                    @error('description') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <!-- Pricing & Inventory -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-800">Giá & Kho hàng</h2>
            </div>
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-slate-700 mb-1">Giá bán (VNĐ)</label>
                    <div class="relative rounded-md shadow-sm">
                        <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" 
                               class="block w-full rounded-xl border-slate-200 pl-4 pr-12 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out" 
                               placeholder="0" required>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-slate-500 sm:text-sm">đ</span>
                        </div>
                    </div>
                    @error('price') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="stock_quantity" class="block text-sm font-medium text-slate-700 mb-1">Số lượng tồn kho</label>
                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity ?? '') }}" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out" 
                           placeholder="0" required>
                    @error('stock_quantity') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="sku" class="block text-sm font-medium text-slate-700 mb-1">Mã SKU</label>
                    <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku ?? '') }}" 
                           class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out" 
                           placeholder="VD: SP-001">
                    @error('sku') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Organization & Media -->
    <div class="space-y-6">
        <!-- Organization -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-800">Phân loại</h2>
            </div>
            <div class="p-6">
                <label for="category_id" class="block text-sm font-medium text-slate-700 mb-1">Danh mục</label>
                <select id="category_id" name="category_id" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out" required>
                    <option value="">Chọn danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category_id', $product->category_id ?? '') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <!-- Media -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden" x-data="{ previews: [] }">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-800">Hình ảnh</h2>
            </div>
            <div class="p-6">
                <label class="block text-sm font-medium text-slate-700 mb-2">Tải ảnh lên</label>
                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:border-indigo-400 transition-colors bg-slate-50 hover:bg-slate-100">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-slate-600 justify-center">
                            <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Chọn file</span>
                                <input id="images" name="images[]" type="file" class="sr-only" multiple accept="image/*"
                                       @change="previews = []; Array.from($event.target.files).forEach(file => { 
                                           let reader = new FileReader();
                                           reader.onload = (e) => { previews.push(e.target.result); };
                                           reader.readAsDataURL(file);
                                       })">
                            </label>
                            <p class="pl-1">hoặc kéo thả vào đây</p>
                        </div>
                        <p class="text-xs text-slate-500">PNG, JPG, GIF lên đến 2MB</p>
                    </div>
                </div>

                <!-- Image Previews -->
                <div x-show="previews.length > 0" class="mt-4 grid grid-cols-3 gap-4">
                    <template x-for="preview in previews">
                        <div class="relative rounded-lg overflow-hidden border border-slate-200 aspect-square group">
                            <img :src="preview" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all"></div>
                        </div>
                    </template>
                </div>

                @error('images.*') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
</div>