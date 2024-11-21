<?php

namespace App\Http\Requests\Voucher;

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
            'code' => 'required',
            'value' =>'required',
            'start_date' =>'required',
            'end_date' =>'required',
            'conditions' =>'required',





        ];
    }

    public function messages(){
        
        return [
            'code.required' => 'Vui lòng nhập code Voucher',
            'value.required' => 'Vui lòng nhập Giá Trị',
            'start_date.required' => 'Vui lòng Chọn Ngày Bắt Đầu',
            'end_date.required' => 'Vui lòng Chọn Ngày Kết Thúc',
            'conditions.required' => 'Vui lòng Nhập Điểu Kiện',

            
        ];
    }
}
