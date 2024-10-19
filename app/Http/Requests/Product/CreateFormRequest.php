<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'category' => 'required',
            'content' => 'required',
            'description' => 'required',
            'price' => 'required',
            'price_sale' => 'required',
            'thumb' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên Sản Phẩm',
            'category.required' => 'Vui lòng nhập Danh Mục',
            'description.required' => 'Vui lòng nhập tên Mô Tả',
            'content.required' => 'Vui lòng nhập tên Mô Tả Chi Tiết',
            'price.required' => 'Vui lòng nhập Giá Gốc',
            'price_sale.required' => 'Vui lòng nhập Giá Khuyến Mãi',
            'thumb.required' => 'Vui lòng Chọn Ảnh',
        ];
    }
}
