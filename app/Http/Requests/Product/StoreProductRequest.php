<?php
namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'product_name' => 'required|string|max:200',
            'product_price' => 'required|numeric',
            'product_discount_price' => 'nullable|numeric',
            'product_image' => 'nullable|image|max:2048',
            'download_document' => 'nullable|file|max:5120',
            // 'status' => 'required|boolean',
        ];
    }
}
