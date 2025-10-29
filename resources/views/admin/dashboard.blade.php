<x-admin-layout>
    <h3 class="text-3xl font-medium text-gray-700">Chào mừng trở lại, {{ Auth::user()->full_name }}!</h3>

    <p class="mt-2 text-gray-600">Đây là trang quản trị của bạn.</p>

    <div class="mt-4">
        <div class="flex flex-wrap -mx-6">
            <div class="w-full px-6 sm:w-1/2 xl:w-1/3">
                <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                    <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
                        </div>
                    <div class="mx-5">
                        <h4 class="text-2xl font-semibold text-gray-700">100</h4>
                        <div class="text-gray-500">Sản phẩm</div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</x-admin-layout>