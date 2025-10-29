@csrf
<div>
    <label for="name" class="block text-sm font-medium text-gray-700">Tên danh mục</label>
    <div class="mt-1">
        <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" class="block w-full rounded-md border-gray-300 shadow-sm" required>
    </div>
    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>
<div class="mt-4">
    <label for="parent_id" class="block text-sm font-medium text-gray-700">Danh mục cha (Tùy chọn)</label>
    <select id="parent_id" name="parent_id" class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base">
        <option value="">Không có</option>
        @foreach($parentCategories as $parent)
            <option value="{{ $parent->id }}" @if(old('parent_id', $category->parent_id ?? '') == $parent->id) selected @endif>
                {{ $parent->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mt-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
    <div class="mt-1">
        <textarea id="description" name="description" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm">{{ old('description', $category->description ?? '') }}</textarea>
    </div>
</div>