<x-admin-layout>
    @section('header')
        Dashboard
    @endsection

    <div class="mb-8">
        <h3 class="text-3xl font-bold text-slate-800">Chào mừng trở lại, {{ Auth::user()->full_name }}! 👋</h3>
        <p class="mt-2 text-slate-500">Đây là tổng quan tình hình kinh doanh của bạn hôm nay.</p>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">
        <!-- Revenue Card -->
        <div class="relative p-6 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-md transition-shadow duration-300">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-green-50 opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
            <div class="relative flex items-center">
                <div class="p-3 bg-green-100 rounded-xl text-green-600">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-bold text-slate-800">{{ number_format($totalRevenue, 0, ',', '.') }} đ</h4>
                    <p class="text-sm font-medium text-slate-500">Tổng doanh thu</p>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-green-500 flex items-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +12.5%
                </span>
                <span class="text-slate-400 ml-2">so với tháng trước</span>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="relative p-6 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-md transition-shadow duration-300">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-blue-50 opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
            <div class="relative flex items-center">
                <div class="p-3 bg-blue-100 rounded-xl text-blue-600">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-bold text-slate-800">{{ $totalOrders }}</h4>
                    <p class="text-sm font-medium text-slate-500">Tổng đơn hàng</p>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-blue-500 flex items-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +5.2%
                </span>
                <span class="text-slate-400 ml-2">so với tháng trước</span>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="relative p-6 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-md transition-shadow duration-300">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-yellow-50 opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
            <div class="relative flex items-center">
                <div class="p-3 bg-yellow-100 rounded-xl text-yellow-600">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-bold text-slate-800">{{ $totalCustomers }}</h4>
                    <p class="text-sm font-medium text-slate-500">Khách hàng</p>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-yellow-500 flex items-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    +2.4%
                </span>
                <span class="text-slate-400 ml-2">so với tháng trước</span>
            </div>
        </div>

        <!-- Products Card -->
        <div class="relative p-6 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden group hover:shadow-md transition-shadow duration-300">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 rounded-full bg-indigo-50 opacity-50 group-hover:scale-110 transition-transform duration-300"></div>
            <div class="relative flex items-center">
                <div class="p-3 bg-indigo-100 rounded-xl text-indigo-600">
                    <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h4 class="text-2xl font-bold text-slate-800">{{ $totalProducts }}</h4>
                    <p class="text-sm font-medium text-slate-500">Sản phẩm</p>
                </div>
            </div>
            <div class="mt-4 flex items-center text-sm">
                <span class="text-indigo-500 flex items-center font-medium">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Mới
                </span>
                <span class="text-slate-400 ml-2">vừa cập nhật</span>
            </div>
        </div>
    </div>

    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8 mt-8">
        <!-- Revenue Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
            <div class="flex items-center justify-between mb-4">
                <h4 class="text-lg font-bold text-slate-800">Biểu đồ Doanh thu</h4>
                <select class="text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option>30 ngày qua</option>
                </select>
            </div>
            <div class="relative h-80 w-full">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Order Status Chart -->
        <div class="bg-white rounded-2xl shadow-sm p-6 border border-slate-100">
            <h4 class="text-lg font-bold text-slate-800 mb-4">Trạng thái đơn hàng</h4>
            <div class="relative h-64 w-full flex justify-center">
                <canvas id="statusChart"></canvas>
            </div>
            <div class="mt-4 grid grid-cols-2 gap-2 text-sm">
                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-emerald-500 mr-2"></span>Đã giao</div>
                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-indigo-500 mr-2"></span>Đang giao</div>
                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>Đang xử lý</div>
                <div class="flex items-center"><span class="w-3 h-3 rounded-full bg-amber-500 mr-2"></span>Chờ xử lý</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Top Products -->
        <div class="lg:col-span-1 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden h-fit">
            <div class="p-6 border-b border-slate-100">
                <h4 class="text-lg font-bold text-slate-800">Top Sản phẩm bán chạy</h4>
            </div>
            <div class="overflow-y-auto max-h-[500px]">
                <ul class="divide-y divide-slate-100">
                    @forelse($topProducts as $item)
                    <li class="p-4 hover:bg-slate-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-slate-100 rounded-lg overflow-hidden">
                                <img src="{{ Storage::url($item->product->images->first()->image_url) ?? 'https://via.placeholder.com/150' }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-slate-900 truncate">
                                    {{ $item->product->name }}
                                </p>
                                <p class="text-xs text-slate-500">
                                    Đã bán: {{ $item->total_sold }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-sm font-semibold text-slate-900">
                                {{ number_format($item->total_revenue, 0, ',', '.') }}đ
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="p-4 text-center text-slate-500 text-sm">Chưa có dữ liệu sản phẩm.</li>
                    @endforelse
                </ul>
            </div>
            <div class="p-4 border-t border-slate-100 bg-slate-50 text-center">
                <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800">Xem tất cả sản phẩm</a>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h4 class="text-lg font-bold text-slate-800">Đơn hàng gần đây</h4>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 flex items-center">
                    Xem tất cả
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="py-4 pl-6 pr-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Mã Đơn</th>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Khách hàng</th>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Tổng tiền</th>
                            <th scope="col" class="px-3 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Trạng thái</th>
                            <th scope="col" class="relative py-4 pl-3 pr-6"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse ($recentOrders as $order)
                        <tr class="hover:bg-slate-50 transition-colors duration-150">
                            <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-slate-900">#{{ $order->order_code }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 text-xs font-bold mr-3">
                                        {{ substr($order->user->full_name ?? 'U', 0, 1) }}
                                    </div>
                                    {{ $order->user->full_name ?? 'N/A' }}
                                </div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm font-semibold text-slate-700">{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-amber-50 text-amber-600 border border-amber-100',
                                        'processing' => 'bg-blue-50 text-blue-600 border border-blue-100',
                                        'shipped' => 'bg-indigo-50 text-indigo-600 border border-indigo-100',
                                        'delivered' => 'bg-emerald-50 text-emerald-600 border border-emerald-100',
                                        'cancelled' => 'bg-rose-50 text-rose-600 border border-rose-100',
                                    ];
                                    $statusLabels = [
                                        'pending' => 'Chờ xử lý',
                                        'processing' => 'Đang xử lý',
                                        'shipped' => 'Đang giao',
                                        'delivered' => 'Đã giao',
                                        'cancelled' => 'Đã hủy',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $statusClasses[$order->status] ?? 'bg-slate-50 text-slate-600 border border-slate-100' }}">
                                    <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-current opacity-60"></span>
                                    {{ $statusLabels[$order->status] ?? ucfirst($order->status) }}
                                </span>
                            </td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors">Xem</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                                    <p>Không có đơn hàng nào gần đây.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Revenue Chart
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            new Chart(ctxRevenue, {
                type: 'line',
                data: {
                    labels: @json($dates),
                    datasets: [{
                        label: 'Doanh thu (VNĐ)',
                        data: @json($revenues),
                        borderColor: '#4f46e5', // Indigo 600
                        backgroundColor: 'rgba(79, 70, 229, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#ffffff',
                        pointBorderColor: '#4f46e5',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.dataset.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    if (context.parsed.y !== null) {
                                        label += new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(context.parsed.y);
                                    }
                                    return label;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                borderDash: [2, 4],
                                color: '#f1f5f9'
                            },
                            ticks: {
                                callback: function(value) {
                                    return new Intl.NumberFormat('vi-VN', { notation: "compact", compactDisplay: "short" }).format(value) + 'đ';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Order Status Chart
            const ctxStatus = document.getElementById('statusChart').getContext('2d');
            new Chart(ctxStatus, {
                type: 'doughnut',
                data: {
                    labels: ['Chờ xử lý', 'Đang xử lý', 'Đang giao', 'Đã giao', 'Đã hủy'],
                    datasets: [{
                        data: @json($statusCounts),
                        backgroundColor: [
                            '#f59e0b', // Amber 500 (Pending)
                            '#3b82f6', // Blue 500 (Processing)
                            '#6366f1', // Indigo 500 (Shipped)
                            '#10b981', // Emerald 500 (Delivered)
                            '#f43f5e'  // Rose 500 (Cancelled)
                        ],
                        borderWidth: 0,
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Custom legend below
                        }
                    },
                    cutout: '70%'
                }
            });
        });
    </script>
</x-admin-layout>