<?php

namespace App\Http\Requests\Customer;

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
            'email' => 'required|email|unique:customers,email', // Kiểm tra định dạng email và không được trùng
            'password' =>'required',
            'phone' =>'required',
            'address' =>'required',

        ];
    }

    public function messages(){
        
        return [
            'name.required' => 'Vui lòng nhập Tên',
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập Mật Khẩu',
            'phone.required' => 'Vui lòng nhập Số Điện Thoại',
            'address.required' => 'Vui lòng nhập Địa Chỉ',
            
        ];
    }
}
