<x-main-layout>
    <!-- Breadcrumb -->
    <section class="bg-gray-50 py-4 border-b">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center gap-2 text-sm">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-indigo-600">Trang chủ</a>
                <span class="text-gray-400">/</span>
                <span class="text-gray-900 font-medium">Tin tức & Công nghệ</span>
            </nav>
        </div>
    </section>

    <!-- Blog Header -->
    <section class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 text-white py-24 relative overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%221%22%3E%3Cpath d=%22M36 34v-4h-4v-4h-4v4h-4v4h4v4h4v-4h4zm0-30V0h-4v4h-4v4h4v4h4V8h4V4h4V0h-4z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        <!-- Floating Orbs -->
        <div class="absolute top-20 left-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/2 w-72 h-72 bg-indigo-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-blob animation-delay-4000"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto fade-in-on-scroll">
                <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-5 py-2.5 rounded-full mb-6 border border-white/30 shadow-lg">
                    <svg class="w-5 h-5 text-yellow-300 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5zM15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z"></path>
                    </svg>
                    <span class="text-white font-bold text-sm tracking-wide">BLOG & TIN TỨC</span>
                </div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold mb-6 drop-shadow-2xl bg-clip-text text-transparent bg-gradient-to-r from-white via-yellow-100 to-white">
                    Tin tức & Công nghệ
                </h1>
                <p class="text-xl md:text-2xl text-indigo-50 leading-relaxed font-light max-w-2xl mx-auto">
                    Cập nhật những tin tức mới nhất về công nghệ, sản phẩm và xu hướng thị trường
                </p>
            </div>
        </div>
    </section>

    <!-- Filter & Search Section -->
    <section class="bg-gray-50 py-8 sticky top-0 z-40 backdrop-blur-md bg-white/80 border-b border-gray-200 shadow-sm">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <!-- Category Filters -->
                <div class="flex items-center gap-3 flex-wrap justify-center">
                    <button onclick="filterPosts('all')" class="filter-btn active px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-indigo-600 text-white shadow-md hover:shadow-lg hover:scale-105">
                        Tất cả
                    </button>
                    <button onclick="filterPosts('Tin tức')" class="filter-btn px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-white text-indigo-600 border-2 border-indigo-200 hover:bg-indigo-50 hover:border-indigo-400 hover:scale-105">
                        Tin tức
                    </button>
                    <button onclick="filterPosts('Hướng dẫn')" class="filter-btn px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-white text-green-600 border-2 border-green-200 hover:bg-green-50 hover:border-green-400 hover:scale-105">
                        Hướng dẫn
                    </button>
                    <button onclick="filterPosts('Đánh giá')" class="filter-btn px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-white text-orange-600 border-2 border-orange-200 hover:bg-orange-50 hover:border-orange-400 hover:scale-105">
                        Đánh giá
                    </button>
                </div>
                
                <!-- Search Bar -->
                <div class="relative w-full md:w-auto min-w-[280px]">
                    <input type="text" id="searchInput" placeholder="Tìm kiếm bài viết..." 
                           class="w-full px-5 py-2.5 pl-12 rounded-full border-2 border-gray-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all duration-300 bg-white shadow-sm hover:shadow-md">
                    <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Posts List -->
    <section class="bg-gradient-to-b from-white to-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="postsGrid">
                @foreach($posts as $index => $post)
                    @php
                        $categoryColors = [
                            'Tin tức' => ['bg' => 'bg-indigo-600', 'gradient' => 'from-indigo-400 to-purple-500'],
                            'Hướng dẫn' => ['bg' => 'bg-green-600', 'gradient' => 'from-green-400 to-blue-500'],
                            'Đánh giá' => ['bg' => 'bg-orange-600', 'gradient' => 'from-orange-400 to-red-500'],
                        ];
                        $colors = $categoryColors[$post['category']] ?? $categoryColors['Tin tức'];
                    @endphp
                    <article class="blog-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 group fade-in-on-scroll" 
                             data-category="{{ $post['category'] }}"
                             data-title="{{ strtolower($post['title']) }}"
                             style="animation-delay: {{ $index * 100 }}ms">
                        <a href="{{ route('blog.show', $post['slug']) }}" class="block h-full">
                            <div class="relative h-56 bg-gradient-to-br {{ $colors['gradient'] }} overflow-hidden">
                                <!-- Gradient Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>
                                <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" 
                                     loading="lazy"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-4 left-4 {{ $colors['bg'] }} text-white px-4 py-1.5 rounded-full text-xs font-bold shadow-xl backdrop-blur-sm border border-white/20 z-20">
                                    {{ $post['category'] }}
                                </div>
                                <!-- Hover Read More Badge -->
                                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500 z-20">
                                    <span class="bg-white text-indigo-600 px-5 py-2 rounded-full text-sm font-semibold shadow-xl flex items-center gap-2">
                                        Đọc ngay
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 bg-white">
                                <div class="flex items-center gap-2 text-xs text-gray-500 mb-4 flex-wrap">
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span>{{ $post['published_at'] }}</span>
                                    </div>
                                    <span class="text-gray-300">•</span>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>{{ $post['read_time'] }}</span>
                                    </div>
                                    <span class="text-gray-300">•</span>
                                    <div class="flex items-center gap-1.5">
                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span>{{ number_format($post['views']) }}</span>
                                    </div>
                                </div>
                                <h3 class="text-xl font-extrabold text-gray-900 mb-3 group-hover:text-indigo-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                    {{ $post['title'] }}
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-3 mb-5 leading-relaxed">
                                    {{ $post['excerpt'] }}
                                </p>
                                <div class="flex items-center gap-2 text-indigo-600 text-sm font-semibold group-hover:gap-3 transition-all duration-300">
                                    <span>Đọc thêm</span>
                                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

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

        // Filter Posts by Category
        function filterPosts(category) {
            const posts = document.querySelectorAll('.blog-card');
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            // Update active button
            filterButtons.forEach(btn => {
                btn.classList.remove('active', 'bg-indigo-600', 'text-white', 'shadow-md');
                btn.classList.add('bg-white', 'border-2');
                if (btn.textContent.trim() === category || (category === 'all' && btn.textContent.trim() === 'Tất cả')) {
                    btn.classList.add('active', 'bg-indigo-600', 'text-white', 'shadow-md');
                    btn.classList.remove('bg-white', 'border-2');
                }
            });
            
            // Filter posts
            posts.forEach(post => {
                const postCategory = post.getAttribute('data-category');
                if (category === 'all' || postCategory === category) {
                    post.style.display = 'block';
                    post.style.animation = 'fadeInUp 0.5s ease-out forwards';
                } else {
                    post.style.display = 'none';
                }
            });
        }

        // Search Functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', (e) => {
                const searchTerm = e.target.value.toLowerCase().trim();
                const posts = document.querySelectorAll('.blog-card');
                
                posts.forEach(post => {
                    const title = post.getAttribute('data-title');
                    const category = post.getAttribute('data-category').toLowerCase();
                    
                    if (title.includes(searchTerm) || category.includes(searchTerm) || searchTerm === '') {
                        post.style.display = 'block';
                        post.style.animation = 'fadeInUp 0.3s ease-out forwards';
                    } else {
                        post.style.display = 'none';
                    }
                });
            });
        }
    </script>
</x-main-layout>

