<x-admin-layout>
    <div class="bg-white p-8 rounded-md shadow-md">
        <h1 class="text-xl font-semibold text-gray-900">Chỉnh sửa người dùng: {{ $user->full_name }}</h1>
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="mt-6 space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="full_name" class="block text-sm font-medium text-gray-700">Họ và tên</label>
                <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $user->full_name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email (Không thể thay đổi)</label>
                <input type="email" id="email" value="{{ $user->email }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100" disabled>
            </div>
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Vai trò</label>
                <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 py-2">
                    <option value="customer" @if(old('role', $user->role) == 'customer') selected @endif>Customer</option>
                    <option value="admin" @if(old('role', $user->role) == 'admin') selected @endif>Admin</option>
                </select>
            </div>
            <div class="flex justify-end pt-5">
                <a href="{{ route('admin.users.index') }}" class="rounded-md border bg-white py-2 px-4 text-sm font-medium text-gray-700">Hủy</a>
                <button type="submit" class="ml-3 inline-flex justify-center rounded-md border bg-indigo-600 py-2 px-4 text-sm text-white">Cập nhật</button>
            </div>
        </form>
    </div>
</x-admin-layout>