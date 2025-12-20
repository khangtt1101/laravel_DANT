<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VoucherController extends Controller
{
    /**
     * Hiển thị danh sách voucher
     */
    public function index(Request $request)
    {
        $query = Voucher::query();

        // Tìm kiếm theo mã hoặc tên
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('code', 'like', '%' . $searchTerm . '%')
                    ->orWhere('name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true)
                    ->where('start_date', '<=', now())
                    ->where('end_date', '>=', now());
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            } elseif ($request->status === 'expired') {
                $query->where('end_date', '<', now());
            }
        }

        $vouchers = $query->latest()->paginate(15)->withQueryString();

        return view('admin.vouchers.index', compact('vouchers'));
    }

    /**
     * Hiển thị form tạo voucher mới
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('admin.vouchers.create', compact('categories'));
    }

    /**
     * Lưu voucher mới
     */
    public function store(Request $request)
    {
        // Sanitize numeric inputs (remove separators)
        $inputs = $request->all();
        $numericFields = ['value', 'min_order_amount', 'max_discount_amount', 'usage_limit', 'usage_limit_per_user'];
        foreach ($numericFields as $field) {
            if (isset($inputs[$field])) {
                $inputs[$field] = str_replace(['.', ','], '', $inputs[$field]);
            }
        }
        $request->merge($inputs);

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:vouchers,code'],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:percentage,fixed'],
            'value' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->type === 'percentage' && $value > 100) {
                        $fail('Giá trị phần trăm không được quá 100.');
                    }
                },
            ],
            'min_order_amount' => ['required', 'numeric', 'min:0'],
            'max_discount_amount' => ['nullable', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:0'],
            'usage_limit_per_user' => ['nullable', 'integer', 'min:0'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'is_active' => ['boolean'],
        ], [
            'code.unique' => 'Mã voucher này đã tồn tại.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',
        ]);

        // Chuyển code thành chữ hoa
        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['used_count'] = 0;
        $validated['is_active'] = $request->has('is_active');
        // Set default start_date if not present
        if (empty($validated['start_date'])) {
            $validated['start_date'] = now()->toDateString();
        }
        // Tránh null cho cột not-null
        $validated['usage_limit_per_user'] = $validated['usage_limit_per_user'] ?? 1;

        $voucher = Voucher::create($validated);

        // Lưu categories (nếu có)
        if ($request->has('categories')) {
            $voucher->categories()->sync($request->categories);
        } else {
            // Nếu không chọn category nào, voucher áp dụng cho tất cả
            $voucher->categories()->sync([]);
        }

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Tạo voucher thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa voucher
     */
    public function edit(Voucher $voucher)
    {
        $voucher->load('categories');
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('admin.vouchers.edit', compact('voucher', 'categories'));
    }

    /**
     * Cập nhật voucher
     */
    public function update(Request $request, Voucher $voucher)
    {
        // Sanitize numeric inputs
        $inputs = $request->all();
        $numericFields = ['value', 'min_order_amount', 'max_discount_amount', 'usage_limit', 'usage_limit_per_user'];
        foreach ($numericFields as $field) {
            if (isset($inputs[$field])) {
                $inputs[$field] = str_replace(['.', ','], '', $inputs[$field]);
            }
        }
        $request->merge($inputs);

        $validated = $request->validate([
            'code' => ['required', 'string', 'max:50', 'unique:vouchers,code,' . $voucher->id],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:percentage,fixed'],
            'value' => [
                'required',
                'numeric',
                'min:0',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->type === 'percentage' && $value > 100) {
                        $fail('Giá trị phần trăm không được quá 100.');
                    }
                },
            ],
            'min_order_amount' => ['required', 'numeric', 'min:0'],
            'max_discount_amount' => ['nullable', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:0'],
            'usage_limit_per_user' => ['nullable', 'integer', 'min:0'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'is_active' => ['boolean'],
        ], [
            'code.unique' => 'Mã voucher này đã tồn tại.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải bằng hoặc sau ngày bắt đầu.',
        ]);

        // Chuyển code thành chữ hoa
        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['is_active'] = $request->has('is_active');
        $validated['usage_limit_per_user'] = $validated['usage_limit_per_user'] ?? 1;

        $voucher->update($validated);

        // Cập nhật categories
        if ($request->has('categories')) {
            $voucher->categories()->sync($request->categories);
        } else {
            // Nếu không chọn category nào, voucher áp dụng cho tất cả
            $voucher->categories()->sync([]);
        }

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Cập nhật voucher thành công!');
    }

    /**
     * Xóa voucher
     */
    public function destroy(Voucher $voucher)
    {
        // Kiểm tra xem voucher đã được sử dụng chưa
        if ($voucher->used_count > 0) {
            return redirect()->route('admin.vouchers.index')
                ->with('error', 'Không thể xóa voucher đã được sử dụng.');
        }

        $voucher->delete();

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Xóa voucher thành công!');
    }

    /**
     * Toggle status voucher
     */
    public function toggleStatus(Voucher $voucher)
    {
        $voucher->is_active = !$voucher->is_active;
        $voucher->save();

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật trạng thái thành công!',
            'is_active' => $voucher->is_active,
        ]);
    }
}


