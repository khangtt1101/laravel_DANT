@csrf
<div class="space-y-8 divide-y divide-gray-200">
    <div class="space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
            <div class="mt-1">
                <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
            </div>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục</label>
            <div class="mt-1">
                <select id="category_id" name="category_id" class="block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" required>
                    <option value="">Chọn một danh mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category_id', $product->category_id ?? '') == $category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
             @error('category_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="sm:col-span-3">
                <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
                <div class="mt-1">
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                 @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div class="sm:col-span-3">
                <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Số lượng tồn kho</label>
                <div class="mt-1">
                    <input type="number" name="stock_quantity" id="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                </div>
                @error('stock_quantity') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>
        
        <div>
            <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
            <div class="mt-1">
                <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            @error('sku') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
            <div class="mt-1">
                <textarea id="description" name="description" rows="5" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description', $product->description ?? '') }}</textarea>
            </div>
             @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div>
            <label for="images" class="block text-sm font-medium text-gray-700">Ảnh sản phẩm</label>
            <div class="mt-1">
                <input type="file" name="images[]" id="images" multiple accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>
            <p class="mt-1 text-xs text-gray-500">Bạn có thể chọn nhiều ảnh cùng lúc.</p>
            @error('images.*') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
    </div>
</div>