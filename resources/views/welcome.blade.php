<x-main-layout>
    <div class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 text-center">
            <h1 class="text-4xl md:text-6xl font-sans text-gray-900 leading-tight">
                Sản phẩm <span class="text-indigo-600">Công nghệ</span>
                <br>
                Dẫn đầu Xu hướng
            </h1>
            <p class="mt-6 max-w-2xl mx-auto text-lg text-gray-500">
                Khám phá bộ sưu tập điện thoại, laptop, và phụ kiện mới nhất với giá ưu đãi nhất.
            </p>
            <div class="mt-8 flex justify-center space-x-4">
                <a href="{{ route('shop.index') }}" class="inline-block bg-indigo-600 text-white font-medium py-3 px-8 rounded-md shadow-md hover:bg-indigo-700">
                    Mua ngay
                </a>
                <a href="#" class="inline-block bg-gray-200 text-gray-700 font-medium py-3 px-8 rounded-md hover:bg-gray-300">
                    Tìm hiểu thêm
                </a>
            </div>
        </div>
    </div>

    <div class="bg-gray-100">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Sản phẩm nổi bật</h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            
            @forelse ($featuredProducts as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl">
                    
                    
                    <a href="#" class="group">
                        
                        
                        <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                            @if (!$product->images->isEmpty())
                        
                                <img src="{{ Storage::url($product->images->first()->image_url) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover transition duration-300 ease-in-out group-hover:scale-105">
                            @else
                                <span class="text-gray-500">(Hình ảnh sản phẩm)</span>
                            @endif
                        </div>

                        <div class="p-6">
                            <h3 class="text-lg font-semibold text-gray-900 truncate" title="{{ $product->name }}">
                                {{ $product->name }}
                            </h3>
                            <p class="mt-2 text-gray-500 text-sm">
                                {{ $product->category->name ?? 'N/A' }}
                            </p>
                            <p class="mt-4 text-xl font-bold text-indigo-600">
                                {{ number_format($product->price, 0, ',', '.') }} đ
                            </p>
                        </div>
                    </a>
                </div>
            @empty
                <p class="text-center col-span-4 text-gray-500">Chưa có sản phẩm nổi bật nào.</p>
            @endforelse
            
        </div>
    </div>
</div>

</x-main-layout>