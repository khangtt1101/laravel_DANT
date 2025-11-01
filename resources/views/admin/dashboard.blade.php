<x-admin-layout>
    <h3 class="text-3xl font-medium text-gray-700">Chào mừng trở lại, {{ Auth::user()->full_name }}!</h3>
    <p class="mt-2 text-gray-600">Đây là trang tổng quan của bạn.</p>

    <div class="mt-4">
        <div class="flex flex-wrap -mx-3">
            
            <div class="w-full px-3 sm:w-1/2 xl:w-1/4">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-green-600 bg-opacity-75 rounded-full">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ number_format($totalRevenue, 0, ',', '.') }} đ</h4>
                        <div class="text-gray-500">Tổng doanh thu</div>
                    </div>
                </div>
            </div>

            <div class="w-full px-3 sm:w-1/2 xl:w-1/4 mt-4 sm:mt-0">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-blue-600 bg-opacity-75 rounded-full">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalOrders }}</h4>
                        <div class="text-gray-500">Tổng đơn hàng</div>
                    </div>
                </div>
            </div>

            <div class="w-full px-3 sm:w-1/2 xl:w-1/4 mt-4 xl:mt-0">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-yellow-600 bg-opacity-75 rounded-full">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalCustomers }}</h4>
                        <div class="text-gray-500">Khách hàng</div>
                    </div>
                </div>
            </div>

            <div class="w-full px-3 sm:w-1/2 xl:w-1/4 mt-4 xl:mt-0">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                        <svg class="w-6 h-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">{{ $totalProducts }}</h4>
                        <div class="text-gray-500">Sản phẩm</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-8">
        <h4 class="text-lg font-semibold text-gray-700">Đơn hàng gần đây</h4>
        <div class="mt-4 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Mã ĐH</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Khách hàng</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tổng tiền</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Trạng thái</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse ($recentOrders as $order)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">#{{ $order->id }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $order->user->full_name ?? 'N/A' }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ number_format($order->total_amount, 0, ',', '.') }} đ</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'processing' => 'bg-blue-100 text-blue-800',
                                                'shipped' => 'bg-indigo-100 text-indigo-800',
                                                'delivered' => 'bg-green-100 text-green-800',
                                                'cancelled' => 'bg-red-100 text-red-800',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900">Xem</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Không có đơn hàng nào gần đây.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </x-admin-layout>