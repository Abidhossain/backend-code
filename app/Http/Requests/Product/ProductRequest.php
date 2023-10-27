<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'description' => 'nullable|max:500',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'price' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
