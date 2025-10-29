<x-admin-layout>
    <div class="bg-white p-8 rounded-md shadow-md">
        <h1 class="text-xl font-semibold text-gray-900">Thêm sản phẩm mới</h1>
        <form method="POST" action="{{ route('admin.products.store') }}" class="mt-6" enctype="multipart/form-data">
            @include('admin.products._form', ['product' => new \App\Models\Product])

            <div class="pt-5">
                <div class="flex justify-end">
                    <a href="{{ route('admin.products.index') }}" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Hủy
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Lưu sản phẩm
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>