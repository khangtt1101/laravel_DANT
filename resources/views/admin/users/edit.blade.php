<x-admin-layout>
    @section('header')
        Chỉnh sửa người dùng
    @endsection

    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-lg font-bold text-slate-800">Thông tin tài khoản</h2>
                <p class="text-sm text-slate-500 mt-1">Cập nhật thông tin cá nhân và quyền hạn của người dùng.</p>
            </div>
            
            <form method="POST" action="{{ route('admin.users.update', $user) }}" class="p-6 space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6">
                    <!-- Full Name -->
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-slate-700 mb-1">Họ và tên</label>
                        <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name) }}" 
                               class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out" required>
                        @error('full_name')
                            <p class="mt-1 text-sm text-rose-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <div class="relative rounded-md shadow-sm">
                            <input type="email" id="email" value="{{ $user->email }}" 
                                   class="block w-full rounded-xl border-slate-200 bg-slate-50 text-slate-500 shadow-sm sm:text-sm cursor-not-allowed" disabled>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-slate-400">Email không thể thay đổi vì lý do bảo mật.</p>
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-slate-700 mb-1">Vai trò</label>
                        <select id="role" name="role" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm transition duration-150 ease-in-out">
                            <option value="customer" @if(old('role', $user->role) == 'customer') selected @endif>Khách hàng</option>
                            <option value="admin" @if(old('role', $user->role) == 'admin') selected @endif>Quản trị viên</option>
                        </select>
                        <p class="mt-1 text-xs text-slate-500">Quản trị viên có toàn quyền truy cập vào hệ thống.</p>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-sm font-medium text-slate-700 hover:bg-slate-50 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Hủy bỏ
                    </a>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 border border-transparent rounded-xl text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-lg shadow-indigo-500/30 transition-colors">
                        Lưu thay đổi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>