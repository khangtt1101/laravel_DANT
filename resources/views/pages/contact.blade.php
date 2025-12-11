<x-main-layout>
    <section class="bg-gradient-to-br from-cyan-500 via-blue-500 to-indigo-600 text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <p class="uppercase text-xs tracking-widest text-white/80 mb-2">PolyTech Support</p>
                    <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-6">
                        Liên hệ đội ngũ hỗ trợ 24/7 của chúng tôi
                    </h1>
                    <p class="text-lg text-white/90 mb-6">
                        Bạn cần tư vấn sản phẩm, hỗ trợ bảo hành hay đặt lịch trải nghiệm? Gửi yêu cầu ngay – chúng tôi sẽ phản hồi trong vòng 15 phút làm việc.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="tel:18002097" class="inline-flex items-center gap-2 bg-white text-indigo-600 font-semibold px-6 py-3 rounded-xl shadow-lg">
                            Gọi hotline
                        </a>
                        <a href="mailto:care@polytech.vn" class="inline-flex items-center gap-2 border border-white/50 text-white font-medium px-6 py-3 rounded-xl hover:bg-white/10 transition">
                            care@polytech.vn
                        </a>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-6 border border-white/30 shadow-xl">
                    <p class="text-sm text-white/80 mb-2">Trung bình phản hồi</p>
                    <p class="text-4xl font-bold">08 phút</p>
                    <p class="text-sm text-white/70">qua chat & mạng xã hội</p>
                    <div class="grid grid-cols-2 gap-6 mt-6">
                        <div>
                            <p class="text-sm text-white/80 mb-1">Tỷ lệ hài lòng</p>
                            <p class="text-3xl font-bold">98%</p>
                            <p class="text-xs text-white/70">hơn 20.000 khách hàng</p>
                        </div>
                        <div>
                            <p class="text-sm text-white/80 mb-1">Trung tâm toàn quốc</p>
                            <p class="text-3xl font-bold">15+</p>
                            <p class="text-xs text-white/70">HN • HCM • ĐN ...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $contactChannels = [
            ['title' => 'Hotline bán hàng', 'info' => '1800 2097', 'desc' => '08:00 – 22:00 mỗi ngày', 'icon' => 'phone'],
            ['title' => 'Hỗ trợ kỹ thuật', 'info' => '1800 1188', 'desc' => 'Bảo hành, sửa chữa, đổi trả', 'icon' => 'wrench'],
            ['title' => 'Email chăm sóc', 'info' => 'care@polytech.vn', 'desc' => 'Phản hồi trong 4 giờ làm việc', 'icon' => 'mail'],
            ['title' => 'Zalo/Livechat', 'info' => 'PolyTech Official', 'desc' => 'Chat trực tuyến 24/7', 'icon' => 'chat'],
        ];

        $stores = [
            ['city' => 'Hà Nội', 'address' => 'Số 10 Phạm Hùng, Nam Từ Liêm', 'time' => '08:00 – 21:30', 'phone' => '024 7300 9090'],
            ['city' => 'TP. HCM', 'address' => '88 Nguyễn Thị Minh Khai, Q.3', 'time' => '08:00 – 22:00', 'phone' => '028 7300 6868'],
            ['city' => 'Đà Nẵng', 'address' => '42 Nguyễn Văn Linh, Q.Hải Châu', 'time' => '08:30 – 21:00', 'phone' => '0236 999 6868'],
        ];
    @endphp

    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($contactChannels as $channel)
                    <div class="border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-lg transition">
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-4">
                            @switch($channel['icon'])
                                @case('phone')
                                    📞
                                    @break
                                @case('wrench')
                                    🛠️
                                    @break
                                @case('mail')
                                    ✉️
                                    @break
                                @default
                                    💬
                            @endswitch
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $channel['title'] }}</h3>
                        <p class="text-2xl font-bold text-indigo-600 mb-2">{{ $channel['info'] }}</p>
                        <p class="text-sm text-gray-500">{{ $channel['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-2 gap-10">
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Gửi yêu cầu trực tuyến</h2>
                <p class="text-gray-600 mb-6">Chúng tôi sẽ liên hệ lại qua email hoặc điện thoại trong tối đa 15 phút (giờ làm việc).</p>
                @if (session('success'))
                    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="space-y-4" method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Họ và tên</label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('full_name') border-red-400 focus:ring-red-500 @enderror"
                                placeholder="Nguyễn Văn A" required>
                            @error('full_name')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Số điện thoại</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('phone') border-red-400 focus:ring-red-500 @enderror"
                                placeholder="0988 xxx xxx">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('email') border-red-400 focus:ring-red-500 @enderror"
                            placeholder="you@example.com" required>
                        @error('email')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-700">Nội dung cần hỗ trợ</label>
                        <textarea rows="4" name="message"
                            class="mt-1 w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('message') border-red-400 focus:ring-red-500 @enderror"
                            placeholder="Mô tả chi tiết nhu cầu của bạn..." required>{{ old('message') }}</textarea>
                        @error('message')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-xl hover:bg-indigo-700 transition">
                        Gửi yêu cầu
                    </button>
                    <p class="text-xs text-gray-400 text-center">Bằng cách gửi form, bạn đồng ý với Chính sách bảo mật của PolyTech.</p>
                </form>
            </div>
            <div>
                <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.308789608181!2d106.6641249760345!3d10.786834389364093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f1f68edec07%3A0xddfd0d72ef88364b!2sHo%20Chi%20Minh%20City%20Book%20Street!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s"
                        width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="bg-white rounded-2xl shadow p-6 border border-gray-100 mt-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Hệ thống cửa hàng</h3>
                    <div class="space-y-4">
                        @foreach($stores as $store)
                            <div class="border border-gray-100 rounded-xl p-4 hover:border-indigo-200 transition">
                                <p class="text-sm uppercase tracking-widest text-indigo-500 font-semibold">{{ $store['city'] }}</p>
                                <p class="text-lg font-semibold text-gray-900">{{ $store['address'] }}</p>
                                <p class="text-sm text-gray-600">Giờ mở cửa: {{ $store['time'] }}</p>
                                <p class="text-sm text-gray-600">Hotline: {{ $store['phone'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-3 gap-6">
            <div class="border border-gray-100 rounded-2xl p-6">
                <h4 class="font-semibold text-gray-900 mb-2">Hỗ trợ bảo hành</h4>
                <p class="text-sm text-gray-600 mb-3">Kiểm tra tình trạng sửa chữa, đặt lịch giao nhận tận nơi.</p>
                <a href="mailto:warranty@polytech.vn" class="inline-flex items-center gap-2 text-indigo-600 font-semibold">warranty@polytech.vn →</a>
            </div>
            <div class="border border-gray-100 rounded-2xl p-6">
                <h4 class="font-semibold text-gray-900 mb-2">Hợp tác doanh nghiệp</h4>
                <p class="text-sm text-gray-600 mb-3">Cung cấp thiết bị IT, giải pháp văn phòng, ưu đãi theo hợp đồng.</p>
                <a href="mailto:biz@polytech.vn" class="inline-flex items-center gap-2 text-indigo-600 font-semibold">biz@polytech.vn →</a>
            </div>
            <div class="border border-gray-100 rounded-2xl p-6">
                <h4 class="font-semibold text-gray-900 mb-2">Trở thành đối tác</h4>
                <p class="text-sm text-gray-600 mb-3">Liên hệ để đặt kệ trưng bày, mở shop-in-shop hoặc nhượng quyền.</p>
                <a href="mailto:partners@polytech.vn" class="inline-flex items-center gap-2 text-indigo-600 font-semibold">partners@polytech.vn →</a>
            </div>
        </div>
    </section>
</x-main-layout>


