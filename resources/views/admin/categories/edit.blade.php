<x-admin-layout>
    <div class="bg-white p-8 rounded-md shadow-md">
        <h1 class="text-xl font-semibold text-gray-900">Chỉnh sửa danh mục</h1>
        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="mt-6 space-y-6">
            @method('PUT')
            @include('admin.categories._form')
            <div class="flex justify-end pt-5">
                <a href="{{ route('admin.categories.index') }}" class="rounded-md border bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">Hủy</a>
                <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Cập nhật</button>
            </div>
        </form>
    </div>
</x-admin-layout>