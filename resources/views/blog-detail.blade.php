<x-main-layout>
    <!-- Breadcrumb -->
    <section class="bg-gray-50 py-4 border-b">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600">Trang chủ</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('blog.index') }}" class="text-gray-600 hover:text-indigo-600">Tin tức</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-900 font-medium line-clamp-1">{{ $post['title'] }}</span>
            </nav>
        </div>
    </section>

    <!-- Blog Detail Content -->
    <article class="bg-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <header class="mb-8 fade-in-on-scroll">
                    @php
                        $categoryColors = [
                            'Tin tức' => 'bg-indigo-600',
                            'Hướng dẫn' => 'bg-green-600',
                            'Đánh giá' => 'bg-orange-600',
                        ];
                        $categoryBg = $categoryColors[$post['category']] ?? 'bg-indigo-600';
                    @endphp
                    <div class="flex items-center gap-2 mb-4 flex-wrap">
                        <span class="{{ $categoryBg }} text-white px-3 py-1 rounded-full text-xs font-semibold shadow-md">
                            {{ $post['category'] }}
                        </span>
                        <span class="text-gray-400">•</span>
                        <span class="text-sm text-gray-600">{{ $post['published_at'] }}</span>
                        <span class="text-gray-400">•</span>
                        <span class="text-sm text-gray-600">{{ $post['read_time'] }}</span>
                        <span class="text-gray-400">•</span>
                        <span class="text-sm text-gray-600">{{ number_format($post['views']) }} lượt xem</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 leading-tight">{{ $post['title'] }}</h1>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-indigo-100 rounded-full flex items-center justify-center">
                            <span class="text-indigo-600 font-bold">{{ substr($post['author'], 0, 1) }}</span>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">{{ $post['author'] }}</div>
                            <div class="text-sm text-gray-500">Tác giả</div>
                        </div>
                    </div>
                </header>

                <!-- Featured Image -->
                <div class="mb-8 rounded-lg overflow-hidden shadow-lg fade-in-on-scroll">
                    <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-auto object-cover rounded-lg">
                </div>

                <!-- Content -->
                <div class="prose prose-lg max-w-none mb-12 fade-in-on-scroll">
                    {!! $post['content'] !!}
                </div>

                <!-- Share Buttons -->
                <div class="border-t border-b border-gray-200 py-6 mb-12 fade-in-on-scroll">
                    <div class="flex items-center gap-4 flex-wrap">
                        <span class="text-gray-700 font-semibold">Chia sẻ bài viết:</span>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post['title']) }}" target="_blank" class="flex items-center gap-2 px-5 py-2.5 bg-sky-500 text-white rounded-lg hover:bg-sky-600 transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                            </svg>
                            Twitter
                        </a>
                        <button onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}'); this.innerHTML='<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M5 13l4 4L19 7\'></path></svg> Đã copy!'; setTimeout(() => this.innerHTML='<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z\'></path></svg> Copy Link</button>', 2000);" class="flex items-center gap-2 px-5 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-all duration-300 hover:scale-105 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            Copy Link
                        </button>
                    </div>
                </div>

                <!-- Related Posts -->
                @if($relatedPosts->count() > 0)
                    <div class="mb-12 fade-in-on-scroll">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Bài viết liên quan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($relatedPosts as $relatedPost)
                                @php
                                    $relatedCategoryColors = [
                                        'Tin tức' => ['bg' => 'bg-indigo-600', 'text' => 'text-indigo-600', 'gradient' => 'from-indigo-400 to-purple-500'],
                                        'Hướng dẫn' => ['bg' => 'bg-green-600', 'text' => 'text-green-600', 'gradient' => 'from-green-400 to-blue-500'],
                                        'Đánh giá' => ['bg' => 'bg-orange-600', 'text' => 'text-orange-600', 'gradient' => 'from-orange-400 to-red-500'],
                                    ];
                                    $relatedColors = $relatedCategoryColors[$relatedPost['category']] ?? $relatedCategoryColors['Tin tức'];
                                @endphp
                                <a href="{{ route('blog.show', $relatedPost['slug']) }}" class="group">
                                    <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
                                        <div class="relative h-40 bg-gradient-to-br {{ $relatedColors['gradient'] }} overflow-hidden">
                                            <img src="{{ $relatedPost['image'] }}" alt="{{ $relatedPost['title'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        </div>
                                        <div class="p-4">
                                            <span class="text-xs {{ $relatedColors['text'] }} font-semibold">{{ $relatedPost['category'] }}</span>
                                            <h3 class="text-sm font-bold text-gray-900 mt-2 group-hover:text-indigo-600 transition line-clamp-2">
                                                {{ $relatedPost['title'] }}
                                            </h3>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Back to Blog -->
                <div class="text-center">
                    <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Quay lại danh sách bài viết
                    </a>
                </div>
            </div>
        </div>
    </article>

    <script>
        // Lazy Loading Animation on Scroll
        document.addEventListener('DOMContentLoaded', () => {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.fade-in-on-scroll').forEach(el => {
                observer.observe(el);
            });
            
            // Fix lazy loading images - add 'loaded' class when image loads
            const lazyImages = document.querySelectorAll('img[loading="lazy"]');
            lazyImages.forEach(img => {
                if (img.complete) {
                    img.classList.add('loaded');
                } else {
                    img.addEventListener('load', function() {
                        this.classList.add('loaded');
                    });
                    img.addEventListener('error', function() {
                        this.classList.add('loaded');
                    });
                }
            });
        });
    </script>
</x-main-layout>

<style>
    .prose {
        @apply text-gray-800;
    }
    .prose h2 {
        @apply text-2xl md:text-3xl font-bold text-gray-900 mt-10 mb-5 pb-2 border-b border-gray-200;
    }
    .prose h3 {
        @apply text-xl md:text-2xl font-bold text-gray-900 mt-8 mb-4;
    }
    .prose p {
        @apply text-gray-700 leading-relaxed mb-5 text-base md:text-lg;
    }
    .prose ul {
        @apply list-disc list-outside mb-6 space-y-3 ml-6;
    }
    .prose ol {
        @apply list-decimal list-outside mb-6 space-y-3 ml-6;
    }
    .prose li {
        @apply text-gray-700 leading-relaxed text-base md:text-lg;
    }
    .prose li::marker {
        @apply text-indigo-600 font-semibold;
    }
    .prose strong {
        @apply font-bold text-gray-900;
    }
    .prose em {
        @apply italic text-gray-700;
    }
    .prose a {
        @apply text-indigo-600 hover:text-indigo-700 underline;
    }
    .prose blockquote {
        @apply border-l-4 border-indigo-500 pl-6 py-2 my-6 italic text-gray-600 bg-indigo-50 rounded-r-lg;
    }
    .prose code {
        @apply bg-gray-100 px-2 py-1 rounded text-sm font-mono text-indigo-700;
    }
    .prose pre {
        @apply bg-gray-900 text-gray-100 p-4 rounded-lg overflow-x-auto my-6;
    }
    .prose pre code {
        @apply bg-transparent text-gray-100 p-0;
    }
    .prose table {
        @apply w-full border-collapse border border-gray-300 my-8 rounded-lg overflow-hidden shadow-md;
    }
    .prose thead {
        @apply bg-indigo-600 text-white;
    }
    .prose th {
        @apply border border-gray-300 p-4 text-left font-semibold;
    }
    .prose td {
        @apply border border-gray-300 p-4;
    }
    .prose tbody tr:nth-child(even) {
        @apply bg-gray-50;
    }
    .prose tbody tr:hover {
        @apply bg-indigo-50;
    }
    .prose img {
        @apply rounded-lg shadow-lg my-8;
    }
</style>

