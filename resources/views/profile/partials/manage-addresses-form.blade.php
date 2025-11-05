<section x-data="{ open: false }">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Sổ địa chỉ') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Quản lý các địa chỉ nhận hàng của bạn.") }}
        </p>
    </header>

    <div class="mt-6 space-y-4">
        @forelse (Auth::user()->addresses as $address)
            <div class="p-4 border rounded-md flex justify-between items-center">
                <div>
                    <p class="font-medium">{{ $address->address_line }}</p>
                    <p class="text-sm text-gray-600">{{ $address->district }}, {{ $address->city }}</p>
                    <p class="text-sm text-gray-600">SĐT: {{ $address->phone_number }}</p>
                </div>
                <form action="{{ route('profile.address.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa địa chỉ này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium">Xóa</button>
                </form>
            </div>
        @empty
            <p class="text-sm text-gray-500">Bạn chưa có địa chỉ nào được lưu.</p>
        @endforelse
    </div>

    <x-primary-button @click="open = !open" class="mt-6">
        <span x-show="!open">{{ __('+ Thêm địa chỉ mới') }}</span>
        <span x-show="open">{{ __('Hủy') }}</span>
    </x-primary-button>

    <form x-show="open" 
          x-transition 
          method="post" 
          action="{{ route('profile.address.store') }}" 
          class="mt-6 space-y-6"
          style="display: none;">
        @csrf
        
        <div>
            <x-input-label for="address_line" :value="__('Địa chỉ (Số nhà, tên đường)')" />
            <x-text-input id="address_line" name="address_line" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('address_line')" class="mt-2" />
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <x-input-label for="district" :value="__('Quận / Huyện')" />
                <x-text-input id="district" name="district" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('district')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="city" :value="__('Tỉnh / Thành phố')" />
                <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" required />
                <x-input-error :messages="$errors->get('city')" class="mt-2" />
            </div>
        </div>
        <div>
            <x-input-label for="phone_number_new" :value="__('Số điện thoại nhận hàng')" />
            <x-text-input id="phone_number_new" name="phone_number" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Lưu địa chỉ') }}</x-primary-button>
        </div>
    </form>
</section>