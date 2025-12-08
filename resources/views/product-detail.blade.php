<x-main-layout>
    <div class="bg-gray-50 py-8 sm:py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Breadcrumbs --}}
            <nav class="flex mb-8 text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="inline-flex items-center hover:text-indigo-600 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Trang chủ
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('shop.index') }}" class="ml-1 md:ml-2 hover:text-indigo-600 transition-colors">Cửa hàng</a>
                        </div>
                    </li>
                    @if($product->category)
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 md:ml-2 text-gray-700 font-medium">{{ $product->category->name }}</span>
                        </div>
                    </li>
                    @endif
                </ol>
            </nav>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 lg:gap-12">
                    
                    {{-- Product Gallery --}}
                    <div class="p-6 lg:p-10 bg-white" x-data="{ 
                        activeImage: '{{ $product->images->isEmpty() ? '' : Storage::url($product->images->first()->image_url) }}',
                        images: [
                            @foreach($product->images as $image)
                                '{{ Storage::url($image->image_url) }}',
                            @endforeach
                        ]
                    }">
                        <div class="relative aspect-square rounded-xl overflow-hidden bg-gray-100 mb-6 group">
                            <template x-if="activeImage">
                                <img :src="activeImage" alt="{{ $product->name }}" class="w-full h-full object-contain object-center transition-transform duration-500 group-hover:scale-105">
                            </template>
                            <template x-if="!activeImage">
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </template>
                            
                            {{-- Image Badge (Optional - e.g. New, Sale) --}}
                            <div class="absolute top-4 left-4">
                                <span class="bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-sm">Mới</span>
                            </div>
                        </div>

                        @if($product->images->count() > 1)
                            <div class="grid grid-cols-5 gap-4">
                                @foreach($product->images as $image)
                                    <button 
                                        @click="activeImage = '{{ Storage::url($image->image_url) }}'" 
                                        class="aspect-square rounded-lg overflow-hidden border-2 transition-all duration-200 focus:outline-none"
                                        :class="activeImage === '{{ Storage::url($image->image_url) }}' ? 'border-indigo-600 ring-2 ring-indigo-100' : 'border-transparent hover:border-gray-300'"
                                    >
                                        <img src="{{ Storage::url($image->image_url) }}" alt="Thumbnail" class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- Product Info --}}
                    <div class="p-6 lg:p-10 lg:pl-0 flex flex-col justify-center">
                        <div class="mb-2">
                            <span class="text-indigo-600 font-semibold tracking-wide uppercase text-sm">
                                {{ $product->category->name ?? 'Sản phẩm' }}
                            </span>
                        </div>
                        
                        <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4 leading-tight">
                            {{ $product->name }}
                        </h1>

                        <div class="flex items-center mb-6">
                            <div class="flex text-yellow-400 text-sm">
                                {{-- Placeholder Stars --}}
                                @for($i = 0; $i < 5; $i++)
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <span class="ml-2 text-gray-500 text-sm">(0 đánh giá)</span>
                        </div>

                        <div class="text-3xl font-bold text-gray-900 mb-8">
                            {{ number_format($product->price, 0, ',', '.') }} <span class="text-xl align-top">₫</span>
                        </div>

                        <div class="prose text-gray-600 mb-8 line-clamp-3">
                            {{ Str::limit($product->description, 150) }}
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

                        {{-- Alerts --}}
                        @if(session('success'))
                            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-r-md shadow-sm flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>{{ session('success') }}</span>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-md shadow-sm flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>{{ session('error') }}</span>
                            </div>
                        @endif

                        <div class="mt-auto" x-data="{ quantity: 1 }">
                            <div class="flex flex-col sm:flex-row gap-4">
                                <div class="w-fit">
                                    <label for="quantity" class="sr-only">Số lượng</label>
                                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden h-12">
                                        <button type="button" @click="if(quantity > 1) quantity--" class="w-10 h-full flex-shrink-0 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 transition-colors focus:outline-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                        </button>
                                        <input type="number" id="quantity" x-model.number="quantity" class="w-12 h-full text-center border-0 focus:ring-0 text-gray-900 font-medium appearance-none" min="1" readonly>
                                        <button type="button" @click="quantity++" class="w-10 h-full flex-shrink-0 flex items-center justify-center bg-gray-50 hover:bg-gray-100 text-gray-600 transition-colors focus:outline-none">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        </button>
                                    </div>
                                </div>

                                <button type="button" 
                                    @click="$store.cart.addToCart({{ $product->id }}, quantity, true)"
                                    class="flex-1 bg-indigo-600 text-white font-bold h-12 rounded-lg shadow-lg shadow-indigo-200 hover:bg-indigo-700 hover:shadow-xl transition-all duration-200 flex items-center justify-center group">
                                    <svg class="w-5 h-5 mr-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                    Thêm vào giỏ hàng
                                </button>
                            </div>
                        </div>
                        
                        {{-- Trust Badges --}}
                        <div class="mt-8 grid grid-cols-2 gap-4 text-sm text-gray-500">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Chính hãng 100%
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Bảo hành 12 tháng
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Giao hàng toàn quốc
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Hỗ trợ 24/7
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabs Section --}}
            <div class="mt-12 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ activeTab: 'description' }">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px">
                        <button @click="activeTab = 'description'" 
                            class="w-1/2 sm:w-auto py-4 px-8 text-center border-b-2 font-medium text-sm sm:text-base transition-colors duration-200 focus:outline-none"
                            :class="activeTab === 'description' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                            Mô tả sản phẩm
                        </button>
                        <button @click="activeTab = 'specs'" 
                            class="w-1/2 sm:w-auto py-4 px-8 text-center border-b-2 font-medium text-sm sm:text-base transition-colors duration-200 focus:outline-none"
                            :class="activeTab === 'specs' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'">
                            Thông số kỹ thuật
                        </button>
                    </nav>
                </div>

                <div class="p-6 sm:p-10">
                    <div x-show="activeTab === 'description'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="prose lg:prose-lg max-w-none text-gray-600">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    <div x-show="activeTab === 'specs'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                        @if($product->specifications)
                            <div class="overflow-hidden border border-gray-200 rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($product->specifications as $key => $value)
                                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 w-1/3">
                                                    {{ $key }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    {{ $value }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500 italic text-center py-8">Chưa có thông số kỹ thuật cho sản phẩm này.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Sản phẩm liên quan</h2>
                @if(isset($relatedProducts) && $relatedProducts->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $item)
                            <a href="{{ route('products.show', ['category' => $item->category->slug ?? $item->category->id, 'product' => $item->slug ?? $item->id]) }}"
                               class="group block bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm hover:shadow-lg transition">
                                <div class="relative h-48 bg-gray-50">
                                    @if($item->images->isNotEmpty())
                                        <img src="{{ Storage::url($item->images->first()->image_url) }}" alt="{{ $item->name }}"
                                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-sm">Chưa có ảnh</div>
                                    @endif
                                    <div class="absolute top-3 left-3">
                                        <span class="bg-indigo-600 text-white text-xs font-semibold px-3 py-1 rounded-full">HOT</span>
                                    </div>
                                </div>
                                <div class="p-4 space-y-2">
                                    <p class="text-xs font-medium text-indigo-600">{{ $item->category->name ?? 'Danh mục' }}</p>
                                    <h3 class="text-sm font-semibold text-gray-900 leading-tight line-clamp-2">{{ $item->name }}</h3>
                                    <p class="text-base font-bold text-indigo-700">{{ number_format($item->price, 0, ',', '.') }} đ</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 rounded-xl p-8 text-center border border-dashed border-gray-300">
                        <p class="text-gray-500">Chưa có sản phẩm liên quan.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <div class="bg-white py-12 border-t border-gray-100">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <h3 class="text-2xl font-semibold text-gray-900 mb-6">Đánh giá sản phẩm</h3>

                @if($canReview)
                    <div class="mb-10 bg-gray-50 border border-gray-200 rounded-xl p-6" x-data="{ selectedRating: {{ old('rating', 5) }} }">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Chia sẻ trải nghiệm của bạn</h4>
                        <form action="{{ route('products.reviews.store', $product) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mức độ hài lòng</label>
                                <div class="flex space-x-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" :checked="selectedRating == {{ $i }}" x-model="selectedRating">
                                            <span @click="selectedRating = {{ $i }}" 
                                                  class="inline-flex items-center justify-center w-10 h-10 rounded-full border transition-all duration-200"
                                                  :class="selectedRating == {{ $i }} ? 'bg-yellow-400 text-white border-yellow-400 shadow-md scale-110' : 'border-gray-300 text-gray-500 hover:border-yellow-300 hover:bg-yellow-50'">
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
                    <div class="mb-10 bg-white border border-gray-200 rounded-xl p-6" x-data="{ selectedRating: {{ old('rating', $userReview->rating) }} }">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Chỉnh sửa đánh giá của bạn</h4>
                        <form action="{{ route('products.reviews.update', [$product, $userReview]) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mức độ hài lòng</label>
                                <div class="flex space-x-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="rating" value="{{ $i }}" class="hidden" :checked="selectedRating == {{ $i }}" x-model="selectedRating">
                                            <span @click="selectedRating = {{ $i }}" 
                                                  class="inline-flex items-center justify-center w-10 h-10 rounded-full border transition-all duration-200"
                                                  :class="selectedRating == {{ $i }} ? 'bg-yellow-400 text-white border-yellow-400 shadow-md scale-110' : 'border-gray-300 text-gray-500 hover:border-yellow-300 hover:bg-yellow-50'">
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