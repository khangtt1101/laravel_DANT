<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    /**
     * Lưu đánh giá sản phẩm của người dùng.
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1200'],
        ]);

        $user = $request->user();

        $hasPurchased = $user->orders()
            ->whereHas('items', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->exists();

        if (! $hasPurchased) {
            return back()->withErrors([
                'comment' => 'Bạn cần mua sản phẩm trước khi đánh giá.',
            ]);
        }

        $alreadyReviewed = $product->reviews()
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyReviewed) {
            return back()->withErrors([
                'comment' => 'Bạn đã đánh giá sản phẩm này rồi.',
            ]);
        }

        $product->reviews()->create([
            'user_id' => $user->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }

    /**
     * Cập nhật đánh giá của người dùng.
     */
    public function update(Request $request, Product $product, Review $review)
    {
        $this->ensureAuthorized($request->user(), $product, $review);

        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:1200'],
        ]);

        $review->update([
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Đã cập nhật đánh giá của bạn.');
    }

    /**
     * Xoá đánh giá của người dùng.
     */
    public function destroy(Request $request, Product $product, Review $review)
    {
        $this->ensureAuthorized($request->user(), $product, $review);

        $review->delete();

        return back()->with('success', 'Đã xoá đánh giá của bạn.');
    }

    protected function ensureAuthorized($user, Product $product, Review $review): void
    {
        if ($review->product_id !== $product->id) {
            abort(404);
        }

        if ($review->user_id !== $user->id) {
            abort(403);
        }
    }
}

