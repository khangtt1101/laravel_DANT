<x-main-layout>
    
    <div class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-12">Sản phẩm nổi bật</h2>
            
            <div class="overflow-x-auto pb-4">
                <div class="grid grid-flow-col auto-cols-[18rem] gap-8">
                    
                    @forelse ($featuredProducts as $product)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl">
                            <a href="#" class="group">
                                <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                                    @if (!$product->images->isEmpty())
                                        <img src="{{ Storage::url($product->images->first()->image_url) }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-full h-full object-cover transition duration-300 ease-in-out group-hover:scale-105">
                                    @else
                                        <span class="text-gray-500">(Không có ảnh)</span>
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
                        <p class="text-center text-gray-500">Chưa có sản phẩm nổi bật nào.</p>
                    @endforelse
                </div>
            </div> </div>
    </div>
    
    <div class="bg-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-12">

            @foreach ($categoriesWithProducts as $category)
                @if ($category->products->isNotEmpty())
                    <section>
                        <div class="flex justify-between items-center mb-8">
                            <h2 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h2>
                            <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                Xem tất cả &rarr;
                            </a>
                        </div>
                        
                        <div class="overflow-x-auto pb-4">
                            <div class="grid grid-flow-col auto-cols-[18rem] gap-8">
                                @foreach ($category->products as $product)
                                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition duration-300 hover:shadow-xl">
                                        <a href="#" class="group">
                                            <div class="h-48 bg-gray-200 flex items-center justify-center overflow-hidden">
                                                @if (!$product->images->isEmpty())
                                                    <img src="{{ Storage::url($product->images->first()->image_url) }}" 
                                                         alt="{{ $product->name }}" 
                                                         class="w-full h-full object-cover transition duration-300 ease-in-out group-hover:scale-105">
                                                @else
                                                    <span class="text-gray-500">(Không có ảnh)</span>
                                                @endif
                                            </div>
                                            <div class="p-6">
                                                <h3 class="text-lg font-semibold text-gray-900 truncate" title="{{ $product->name }}">
                                                    {{ $product->name }}
                                                </h3>
                                                <p class="mt-2 text-gray-500 text-sm">
                                                    {{ $category->name }}
                                                </p>
                                                <p class="mt-4 text-xl font-bold text-indigo-600">
                                                    {{ number_format($product->price, 0, ',', '.') }} đ
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div> </section>
                @endif
            @endforeach

        </div>
    </div>
    
</x-main-layout>