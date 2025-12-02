<x-admin-layout>
    @section('header')
        Chỉnh sửa sản phẩm
    @endsection

    <div class="max-w-5xl mx-auto">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Chỉnh sửa sản phẩm</h1>
                <p class="text-sm text-slate-500 mt-1">Cập nhật thông tin và hình ảnh sản phẩm.</p>
            </div>
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors shadow-sm">
                Quay lại
            </a>
        </div>

        @if(session('error'))
            <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 px-4 py-3 rounded-xl relative flex items-center shadow-sm" role="alert">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @include('admin.products._form')

            <!-- Existing Images Section -->
            <div class="mt-6 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                    <h2 class="text-lg font-bold text-slate-800">Ảnh hiện tại</h2>
                    <p class="text-sm text-slate-500 mt-1">Chọn ảnh bạn muốn xóa.</p>
                </div>
                <div class="p-6">
                    @if ($product->images->count() > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-5 gap-4">
                            @foreach ($product->images as $image)
                                <div class="relative group rounded-xl overflow-hidden border border-slate-200 bg-slate-50">
                                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden">
                                        <img src="{{ Storage::url($image->image_url) }}" alt="{{ $image->alt_text ?? 'Ảnh sản phẩm' }}" class="w-full h-32 object-cover object-center group-hover:opacity-75 transition-opacity">
                                    </div>
                                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-200"></div>
                                    <div class="absolute top-2 right-2">
                                        <label for="delete_image_{{ $image->id }}" class="flex items-center justify-center w-8 h-8 bg-white/90 backdrop-blur-sm rounded-full cursor-pointer hover:bg-rose-50 border border-slate-200 shadow-sm transition-all duration-200">
                                            <input type="checkbox" name="delete_images[]" id="delete_image_{{ $image->id }}" value="{{ $image->id }}" class="h-4 w-4 text-rose-600 border-slate-300 rounded focus:ring-rose-500 cursor-pointer">
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="mt-2 text-sm text-slate-500">Sản phẩm này chưa có ảnh nào.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3 pb-8">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    Hủy bỏ
                </a>
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 border border-transparent rounded-xl text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 transition-colors">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>