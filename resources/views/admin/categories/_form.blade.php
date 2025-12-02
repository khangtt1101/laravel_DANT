@csrf
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-6 border-b border-slate-100 bg-slate-50/50">
        <h2 class="text-lg font-bold text-slate-800">Thông tin danh mục</h2>
        <p class="text-sm text-slate-500 mt-1">Điền thông tin chi tiết cho danh mục sản phẩm.</p>
    </div>
    <div class="p-6 space-y-6">
        <div>
            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Tên danh mục</label>
            <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" 
                   class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out" 
                   placeholder="Nhập tên danh mục..." required>
            @error('name') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="parent_id" class="block text-sm font-medium text-slate-700 mb-1">Danh mục cha (Tùy chọn)</label>
            <select id="parent_id" name="parent_id" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                <option value="">-- Không có (Danh mục gốc) --</option>
                @foreach($parentCategories as $parent)
                    <option value="{{ $parent->id }}" @if(old('parent_id', $category->parent_id ?? '') == $parent->id) selected @endif>
                        {{ $parent->name }}
                    </option>
                @endforeach
            </select>
            <p class="mt-1 text-xs text-slate-500">Chọn danh mục cha nếu đây là danh mục con.</p>
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-slate-700 mb-1">Mô tả</label>
            <textarea id="description" name="description" rows="4" 
                      class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out"
                      placeholder="Mô tả ngắn về danh mục này...">{{ old('description', $category->description ?? '') }}</textarea>
        </div>
    </div>
</div>