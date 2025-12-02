<x-admin-layout>
    @section('header')
        Thêm sản phẩm mới
    @endsection

    <div class="max-w-5xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Thêm sản phẩm mới</h1>
                <p class="text-sm text-slate-500 mt-1">Điền thông tin chi tiết để tạo sản phẩm mới.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors shadow-sm">
                Quay lại
            </a>
        </div>

        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @include('admin.products._form', ['product' => new \App\Models\Product])

            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Hủy bỏ
                </a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 border border-transparent rounded-xl text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 transition-colors">
                    Lưu sản phẩm
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>