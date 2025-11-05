<x-admin-layout>
    <div class="bg-white p-8 rounded-md shadow-md">
        <h1 class="text-xl font-semibold text-gray-900">Chỉnh sửa sản phẩm: {{ $product->name }}</h1>

        @if(session('error'))
            <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.products.update', $product) }}" class="mt-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            @include('admin.products._form')

            <div class="mt-8 border-t pt-6">
                <h3 class="text-lg font-medium text-gray-900">Ảnh hiện tại</h3>
                @if ($product->images->count() > 0)
                    <div class="mt-4 grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-4">
                        @foreach ($product->images as $image)
                            <div class="relative group">
                                <img src="{{ Storage::url($image->image_url) }}" alt="{{ $image->alt_text ?? 'Ảnh sản phẩm' }}" class="w-full h-32 object-cover rounded-md">
                                <div class="absolute top-1 right-1">
                                    <label for="delete_image_{{ $image->id }}" class="flex items-center p-1 bg-white bg-opacity-75 rounded-full cursor-pointer hover:bg-red-200">
                                        <input type="checkbox" name="delete_images[]" id="delete_image_{{ $image->id }}" value="{{ $image->id }}" class="h-4 w-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                        <span class="ml-1 text-xs text-red-700 font-medium select-none">Xóa</span>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-2 text-sm text-gray-500">Sản phẩm này chưa có ảnh.</p>
                @endif
            </div>
            <div class="pt-8 mt-8 border-t">
                <div class="flex justify-end">
                    <a href="{{ route('admin.products.index') }}" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50">
                        Hủy
                    </a>
                    <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                        Cập nhật
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>