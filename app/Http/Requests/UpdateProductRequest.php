<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        // Loại bỏ dấu chấm trong giá và số lượng trước khi validate
        $this->merge([
            'price' => $this->price ? str_replace('.', '', $this->price) : null,
            'stock_quantity' => $this->stock_quantity ? str_replace('.', '', $this->stock_quantity) : null,
        ]);
    }

    public function rules()
    {
        // Lấy ID sản phẩm hiện tại từ route để ignore khi check unique
        $product = $this->route('product');

        return [
            'name' => 'required|string|max:255|unique:products,name,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku,' . $product->id,
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'specifications' => 'nullable|array',
            'specifications.*.name' => 'required|string|max:255',
            'specifications.*.value' => 'required|string|max:255',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:product_images,id',
        ];
    }
}
