<x-main-layout>
    <section class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-10 items-center">
                <div>
                    <p class="uppercase tracking-widest text-sm text-white/80 mb-2">Đặc quyền tháng {{ now()->format('m/Y') }}</p>
                    <h1 class="text-4xl lg:text-5xl font-bold leading-tight mb-6">
                        Săn deal công nghệ cực đỉnh – giảm đến <span class="text-yellow-300">50%</span>
                    </h1>
                    <p class="text-lg text-white/90 mb-6">
                        Tổng hợp chương trình khuyến mãi đang diễn ra tại PolyTech Store. Đổi máy mới, sắm phụ kiện, tích điểm nhận quà – tất cả trong một trang duy nhất.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('shop.index') }}"
                            class="inline-flex items-center gap-2 bg-white text-indigo-700 font-semibold px-6 py-3 rounded-xl shadow-lg hover:-translate-y-1 transition">
                            Khám phá sản phẩm
                            <span>→</span>
                        </a>
                        <a href="#voucher" class="inline-flex items-center gap-2 border border-white/50 text-white font-medium px-6 py-3 rounded-xl hover:bg-white/10 transition">
                            Lấy mã giảm giá
                        </a>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-xl rounded-2xl p-6 border border-white/30 shadow-2xl">
                    <div class="flex justify-between text-sm text-white/80 mb-2">
                        <span>Trạng thái chiến dịch</span>
                        <span>Đang diễn ra</span>
                    </div>
                    <div class="w-full h-2 rounded-full bg-white/20">
                        <div class="h-full rounded-full bg-yellow-300" style="width: 72%;"></div>
                    </div>
                    <div class="grid grid-cols-2 gap-6 mt-6">
                        <div>
                            <p class="text-sm text-white/80 mb-1">Đã phát</p>
                            <p class="text-3xl font-bold">1.250+</p>
                            <p class="text-xs text-white/70">voucher & ưu đãi</p>
                        </div>
                        <div>
                            <p class="text-sm text-white/80 mb-1">Đơn hàng áp dụng</p>
                            <p class="text-3xl font-bold">3.800+</p>
                            <p class="text-xs text-white/70">trong tuần qua</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap items-center justify-between gap-4 mb-10">
                <div>
                    <p class="text-indigo-600 uppercase text-xs font-semibold tracking-widest">Flash deal</p>
                    <h2 class="text-3xl font-bold text-gray-900">Ưu đãi nổi bật</h2>
                    <p class="text-gray-600 mt-2">Các chương trình hot nhất hiện tại – số lượng có hạn.</p>
                </div>
                <div class="flex flex-wrap gap-2" data-flash-filters>
                    @foreach($flashFilters as $filter)
                        <button
                            class="filter-chip px-4 py-2 rounded-full text-sm font-medium border border-gray-200 text-gray-600 hover:bg-gray-100 transition"
                            data-filter-button
                            data-filter="{{ $filter['slug'] }}"
                            @if($loop->first) data-active="true" @endif
                        >
                            {{ $filter['label'] }}
                        </button>
                    @endforeach
                </div>
            </div>

            @if(count($flashDeals))
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($flashDeals as $deal)
                        @php
                            $categorySlugs = collect($deal['categories'])->pluck('slug')->implode(',');
                            $pillClass = $deal['colors']['pill'] ?? 'bg-slate-100 text-slate-600';
                            $cardClass = $deal['colors']['card'] ?? 'from-slate-500/10 to-slate-100';
                            $buttonClass = $deal['colors']['button'] ?? 'bg-indigo-600 text-white hover:bg-indigo-700';
                        @endphp
                        <div
                            class="flash-deal-card bg-gradient-to-br {{ $cardClass }} rounded-2xl p-6 border border-white shadow-sm hover:shadow-xl transition"
                            data-deal-categories="{{ $categorySlugs ?: 'all' }}">
                            <div class="flex items-center justify-between mb-6">
                                <span class="px-4 py-1 text-xs font-semibold rounded-full {{ $pillClass }}">
                                    {{ $deal['tag'] }}
                                </span>
                                <span class="text-sm text-gray-600">
                                    @if($deal['expires'])
                                        Hết hạn: {{ $deal['expires'] }}
                                    @else
                                        Đang diễn ra
                                    @endif
                                </span>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $deal['title'] }}</h3>
                            <p class="text-gray-600 mb-6">{{ $deal['description'] }}</p>
                            <div class="flex items-center justify-between">
                                <a href="{{ route('shop.index') }}" class="text-indigo-600 font-semibold hover:text-indigo-800 transition">
                                    Xem chi tiết
                                </a>
                                <button
                                    class="px-4 py-2 text-sm font-medium rounded-full shadow hover:-translate-y-0.5 transition {{ $buttonClass }}"
                                    onclick="copyVoucherCode('{{ $deal['code'] }}', this)">
                                    <span class="copy-text">Sao chép mã</span>
                                </button>
                            </div>
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach($deal['categories'] as $category)
                                    <span class="text-xs px-2 py-1 bg-white/80 text-gray-700 rounded-full">
                                        {{ $category['name'] }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 text-gray-600">
                    Hiện chưa có voucher nào để hiển thị trong mục này.
                </div>
            @endif
        </div>
    </section>

    <section id="voucher" class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <p class="text-pink-500 uppercase text-xs font-semibold tracking-widest mb-2">Voucher độc quyền</p>
                <h2 class="text-3xl font-bold text-gray-900">Chọn mã phù hợp – áp dụng chỉ với 1 chạm</h2>
                <p class="text-gray-600 mt-3">Đăng nhập để lưu và tự động áp dụng khi thanh toán.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach($voucherGroups as $group)
                    @if($group['vouchers']->count() > 0)
                        @php
                            $bgColorClass = $group['color'] === 'indigo' ? 'bg-indigo-50' : ($group['color'] === 'emerald' ? 'bg-emerald-50' : 'bg-pink-50');
                            $textColorClass = $group['color'] === 'indigo' ? 'text-indigo-600' : ($group['color'] === 'emerald' ? 'text-emerald-600' : 'text-pink-600');
                            $hoverColorClass = $group['color'] === 'indigo' ? 'hover:text-indigo-700' : ($group['color'] === 'emerald' ? 'hover:text-emerald-700' : 'hover:text-pink-700');
                        @endphp
                        <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm hover:shadow-lg transition">
                            <span class="inline-flex items-center px-3 py-1 text-xs font-semibold rounded-full {{ $bgColorClass }} {{ $textColorClass }} mb-4">
                                {{ $group['label'] }}
                            </span>
                            <div class="space-y-4">
                                @foreach($group['vouchers'] as $voucher)
                                    <div class="p-4 border border-dashed border-gray-200 rounded-xl flex flex-col gap-2">
                                        <div class="flex items-center justify-between">
                                            <h4 class="font-semibold text-gray-900 text-lg">{{ $voucher->code }}</h4>
                                            <button 
                                                onclick="copyVoucherCode('{{ $voucher->code }}', this)"
                                                class="text-sm {{ $textColorClass }} font-medium {{ $hoverColorClass }} transition">
                                                <span class="copy-text">Sao chép</span>
                                            </button>
                                        </div>
                                        <p class="text-sm font-medium text-gray-900">{{ $voucher->name }}</p>
                                        @if($voucher->description)
                                            <p class="text-sm text-gray-600">{{ $voucher->description }}</p>
                                        @endif
                                        <div class="flex flex-wrap gap-2 mt-2">
                                            @if($voucher->type === 'percentage')
                                                <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded">Giảm {{ $voucher->value }}%</span>
                                            @else
                                                <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded">Giảm {{ number_format($voucher->value, 0, ',', '.') }} đ</span>
                                            @endif
                                            @if($voucher->min_order_amount > 0)
                                                <span class="text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded">Đơn tối thiểu {{ number_format($voucher->min_order_amount, 0, ',', '.') }} đ</span>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500 mt-1">Hết hạn: {{ $voucher->end_date->format('d/m/Y') }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-400 mt-4">* Mỗi mã sử dụng tối đa 1 lần/khách. Không áp dụng đồng thời.</p>
                        </div>
                    @endif
                @endforeach
            </div>
            
            @if($activeVouchers->count() === 0)
                <div class="text-center py-12">
                    <p class="text-gray-600">Hiện tại chưa có voucher nào đang hoạt động.</p>
                </div>
            @endif
        </div>
    </section>

    <section class="bg-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Lịch ưu đãi trong tháng</h3>
                    <ul class="space-y-5">
                        <li class="flex gap-4">
                            <div class="w-12 text-right">
                                <p class="text-lg font-bold text-indigo-600">05</p>
                                <p class="text-xs text-gray-500 uppercase">Th12</p>
                            </div>
                            <div class="flex-1 border-l-2 border-indigo-200 pl-4">
                                <h4 class="font-semibold text-gray-900">Ngày mở bán Galaxy S24</h4>
                                <p class="text-sm text-gray-600">Đặt trước tặng quà 6 triệu + trả góp 0%</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="w-12 text-right">
                                <p class="text-lg font-bold text-indigo-600">12</p>
                                <p class="text-xs text-gray-500 uppercase">Th12</p>
                            </div>
                            <div class="flex-1 border-l-2 border-indigo-200 pl-4">
                                <h4 class="font-semibold text-gray-900">Tuần lễ Apple Day</h4>
                                <p class="text-sm text-gray-600">Voucher 2 triệu + đổi máy cũ trợ giá 40%</p>
                            </div>
                        </li>
                        <li class="flex gap-4">
                            <div class="w-12 text-right">
                                <p class="text-lg font-bold text-indigo-600">24</p>
                                <p class="text-xs text-gray-500 uppercase">Th12</p>
                            </div>
                            <div class="flex-1 border-l-2 border-indigo-200 pl-4">
                                <h4 class="font-semibold text-gray-900">Noel Sale</h4>
                                <p class="text-sm text-gray-600">Mua phụ kiện giảm 40%, quà độc quyền</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-6 border border-indigo-100">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Đặc quyền thành viên PolyCare+</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-white shadow flex items-center justify-center text-indigo-600 font-bold">1</div>
                            <div>
                                <p class="font-semibold text-gray-900">Gấp đôi điểm thưởng</p>
                                <p class="text-sm text-gray-600">Tích điểm đến 6% giá trị đơn hàng, đổi voucher trong 24h</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-white shadow flex items-center justify-center text-indigo-600 font-bold">2</div>
                            <div>
                                <p class="font-semibold text-gray-900">Bảo hành VIP 24h</p>
                                <p class="text-sm text-gray-600">Ưu tiên xử lý và miễn phí giao – nhận tận nhà</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-white shadow flex items-center justify-center text-indigo-600 font-bold">3</div>
                            <div>
                                <p class="font-semibold text-gray-900">Kênh săn deal riêng</p>
                                <p class="text-sm text-gray-600">Thông báo trước 12h, giữ hàng tối đa 30 phút</p>
                            </div>
                        </li>
                    </ul>
                    <div class="mt-6">
                        <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition">
                            Đăng ký PolyCare+
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <div>
                    <p class="text-amber-400 uppercase text-xs font-semibold tracking-widest mb-2">F.A.Q</p>
                    <h2 class="text-3xl font-bold mb-4">Câu hỏi thường gặp về khuyến mãi</h2>
                    <p class="text-white/80">Chúng tôi tổng hợp các thắc mắc được hỏi nhiều nhất để bạn dễ dàng chuẩn bị trước khi mua.</p>
                </div>
                <div class="space-y-4">
                    <details class="bg-white/5 rounded-xl p-4 border border-white/10" open>
                        <summary class="font-semibold cursor-pointer">Làm sao để nhận thông báo sớm?</summary>
                        <p class="text-sm text-white/70 mt-2">Đăng ký PolyCare+ hoặc bật thông báo trong ứng dụng, bạn sẽ nhận email/SMS trước ít nhất 12 giờ.</p>
                    </details>
                    <details class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <summary class="font-semibold cursor-pointer">Có áp dụng chung nhiều voucher?</summary>
                        <p class="text-sm text-white/70 mt-2">Một đơn hàng chỉ dùng được một voucher giảm tiền. Tuy nhiên vẫn cộng dồn với ưu đãi trả góp, thu cũ đổi mới, freeship.</p>
                    </details>
                    <details class="bg-white/5 rounded-xl p-4 border border-white/10">
                        <summary class="font-semibold cursor-pointer">Tôi đã đặt cọc – khi nào nhận máy?</summary>
                        <p class="text-sm text-white/70 mt-2">Đơn hàng đặt trước sẽ được ưu tiên giao trong vòng 24h sau thời điểm mở bán. Bạn sẽ nhận SMS xác nhận lịch giao cụ thể.</p>
                    </details>
                </div>
            </div>
        </div>
    </section>
</x-main-layout>

<script>
function copyVoucherCode(code, button) {
    // Copy mã vào clipboard
    navigator.clipboard.writeText(code).then(function() {
        // Thay đổi text của button
        const copyText = button.querySelector('.copy-text');
        const originalText = copyText.textContent;
        copyText.textContent = 'Đã sao chép!';
        button.classList.add('text-green-600');
        button.classList.remove('text-indigo-600', 'text-emerald-600', 'text-pink-600');
        
        // Hiển thị thông báo (optional)
        // Có thể thêm toast notification ở đây nếu muốn
        
        // Đổi lại sau 2 giây
        setTimeout(function() {
            copyText.textContent = originalText;
            button.classList.remove('text-green-600');
            // Khôi phục màu gốc dựa trên group color (cần xử lý thêm nếu muốn)
        }, 2000);
    }).catch(function(err) {
        console.error('Lỗi khi sao chép:', err);
        alert('Không thể sao chép mã. Vui lòng sao chép thủ công: ' + code);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('[data-filter-button]');
    const dealCards = document.querySelectorAll('[data-deal-categories]');

    if (!filterButtons.length) {
        return;
    }

    const setActiveButton = (activeButton) => {
        filterButtons.forEach(btn => btn.classList.remove('filter-chip--active'));
        activeButton.classList.add('filter-chip--active');
    };

    filterButtons.forEach(button => {
        if (button.dataset.filter === 'all' && button.dataset.active === 'true') {
            setActiveButton(button);
        }

        button.addEventListener('click', () => {
            const filter = button.dataset.filter;
            setActiveButton(button);

            dealCards.forEach(card => {
                const categories = card.dataset.dealCategories.split(',');
                const shouldShow = filter === 'all' || categories.includes(filter);
                card.classList.toggle('hidden', !shouldShow);
            });
        });
    });
});
</script>




