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

                    <div class="mt-4">
                        <div class="flex items-center">
                            <div class="flex text-yellow-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="h-5 w-5 {{ ($averageRating ?? 0) >= $i ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L3.98 8.72c-.783-.57-.38-1.81.588-1.81H8.03a1 1 0 00.95-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="ml-2 text-sm text-gray-600">
                                @if($reviewsCount > 0)
                                    {{ $averageRating }}/5 · {{ $reviewsCount }} đánh giá
                                @else
                                    Chưa có đánh giá
                                @endif
                            </p>
                        </div>
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

    <div class="bg-white py-12 border-t border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Đánh giá sản phẩm</h3>

                @if($canReview)
                    <div class="mb-10 bg-gray-50 border border-gray-200 rounded-xl p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Chia sẻ trải nghiệm của bạn</h4>
                        <form action="{{ route('products.reviews.store', $product) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mức độ hài lòng</label>
                                <div class="flex space-x-2">
                                    @php $selectedRating = old('rating', 5); @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" @checked($selectedRating == $i)>
                                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full border {{ $selectedRating == $i ? 'bg-yellow-400 text-white border-yellow-400' : 'border-gray-300 text-gray-500' }}">
                                                {{ $i }}
                                            </span>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Nhận xét</label>
                                <textarea name="comment" id="comment" rows="4" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Sản phẩm có tốt không? Bạn thích điều gì nhất?">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Gửi đánh giá
                            </button>
                        </form>
                    </div>
                @elseif(Auth::guest())
                    <div class="mb-10 bg-gray-50 border border-gray-200 rounded-xl p-6 text-sm text-gray-600">
                        Vui lòng <a href="{{ route('login') }}" class="text-indigo-600 font-medium">đăng nhập</a> để đánh giá sản phẩm.
                    </div>
                @elseif($userReview)
                    <div class="mb-10 bg-white border border-gray-200 rounded-xl p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Chỉnh sửa đánh giá của bạn</h4>
                        <form action="{{ route('products.reviews.update', [$product, $userReview]) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mức độ hài lòng</label>
                                <div class="flex space-x-2">
                                    @php $editRating = old('rating', $userReview->rating); @endphp
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" @checked($editRating == $i)>
                                            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full border {{ $editRating == $i ? 'bg-yellow-400 text-white border-yellow-400' : 'border-gray-300 text-gray-500' }}">
                                                {{ $i }}
                                            </span>
                                        </label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Nhận xét</label>
                                <textarea name="comment" id="comment" rows="4" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" placeholder="Chia sẻ thêm về trải nghiệm của bạn">{{ old('comment', $userReview->comment) }}</textarea>
                                @error('comment')
                                    <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                    Cập nhật đánh giá
                                </button>
                            </div>
                        </form>
                        <form action="{{ route('products.reviews.destroy', [$product, $userReview]) }}" method="POST" class="mt-4" onsubmit="return confirm('Bạn chắc chắn muốn xoá đánh giá này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-100 text-red-600 rounded-lg font-medium hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-200">
                                Xoá đánh giá
                            </button>
                        </form>
                    </div>
                @endif

                <div class="space-y-6">
                    @forelse($reviews as $review)
                        <div class="border border-gray-200 rounded-xl p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-base font-semibold text-gray-900">{{ $review->user->full_name ?? 'Người dùng' }}</p>
                                    <div class="flex text-yellow-400 mt-1">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="h-4 w-4 {{ $review->rating >= $i ? 'text-yellow-400' : 'text-gray-300' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L3.98 8.72c-.783-.57-.38-1.81.588-1.81H8.03a1 1 0 00.95-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500">{{ $review->created_at->format('d/m/Y') }}</p>
                            </div>
                            @if($review->comment)
                                <p class="mt-4 text-gray-700 whitespace-pre-line">{{ $review->comment }}</p>
                            @endif
                        </div>
                    @empty
                        <div class="text-center text-gray-500 border border-dashed border-gray-300 rounded-xl py-8">
                            Chưa có đánh giá nào. Hãy là người đầu tiên!
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-main-layout>