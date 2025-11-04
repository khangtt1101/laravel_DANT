<x-main-layout>
    <div class="bg-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                <div
                    x-data="{ mainImage: '{{ $product->images->isEmpty() ? '' : Storage::url($product->images->first()->image_url) }}' }">
                    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden aspect-square">
                        <img x-show="mainImage" :src="mainImage" alt="{{ $product->name }}"
                            class="w-full h-full object-cover transition-opacity duration-300">
                        @if($product->images->isEmpty())
                            <div class="w-full h-full flex items-center justify-center text-gray-500">(Không có ảnh)</div>
                        @endif
                    </div>

                    @if($product->images->count() > 1)
                        <div class="mt-4 overflow-x-auto pb-2">
                            <div class="flex space-x-4">
                                @foreach($product->images as $image)
                                    <div @click="mainImage = '{{ Storage::url($image->image_url) }}'"
                                        class="flex-shrink-0 w-24 h-24 rounded-md overflow-hidden cursor-pointer border-2"
                                        :class="{'border-indigo-500': mainImage === '{{ Storage::url($image->image_url) }}'}">
                                        <img src="{{ Storage::url($image->image_url) }}" alt="Thumbnail"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <div>
                    <p class="text-sm font-medium text-indigo-600">
                        {{ $product->category->name ?? 'Chưa phân loại' }}
                    </p>

                    <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900">
                        {{ $product->name }}
                    </h1>

                    <div class="mt-4">
                        <p class="text-3xl font-bold text-gray-900">
                            {{ number_format($product->price, 0, ',', '.') }} đ
                        </p>
                    </div>

                    <div class="mt-8">
                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                                role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                                role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="flex items-center space-x-4 mb-6" x-data="{ quantity: 1 }">
                                <label for="quantity" class="font-medium text-gray-700">Số lượng:</label>
                                <div class="flex items-center border border-gray-300 rounded-md">
                                    <button type="button" @click="quantity = Math.max(1, quantity - 1)"
                                        class="px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-l-md">
                                        -
                                    </button>
                                    <input type="text" name="quantity" id="quantity" x-model="quantity"
                                        class="w-12 text-center border-0 focus:ring-0" readonly>
                                    <button type="button" @click="quantity++"
                                        class="px-3 py-2 text-gray-600 hover:bg-gray-100 rounded-r-md">
                                        +
                                    </button>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-indigo-600 text-white font-medium py-3 px-8 rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Thêm vào giỏ hàng
                            </button>
                        </form>
                    </div>

                    <div class="mt-8 prose lg:prose-lg max-w-none">
                        <h4 class="text-lg font-medium text-gray-900">Mô tả sản phẩm</h4>
                        <p class="text-gray-600">
                            {!! nl2br(e($product->description)) !!}
                        </p>
                    </div>

                    @if($product->specifications)
                        <div class="mt-8 prose lg:prose-lg max-w-none">
                            <h4 class="text-lg font-medium text-gray-900">Thông số kỹ thuật</h4>
                            <ul class="list-disc list-inside space-y-2 mt-2 text-gray-600">
                                @foreach($product->specifications as $key => $value)
                                    <li><strong>{{ $key }}:</strong> {{ $value }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-main-layout>