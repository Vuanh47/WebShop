<?php

namespace App\Http\Requests\Menu;

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
            'description' =>'required',
            'thumb' =>'required',
        ];
    }

    public function messages(){
        
        return [
            'name.required' => 'Vui lòng nhập tên Danh Mục',
            'description.required' => 'Vui lòng nhập Chi Tiết Mô Tả',
            'thumb.required' => 'Vui lòng Chọn Ảnh',
            
        ];
    }
}
