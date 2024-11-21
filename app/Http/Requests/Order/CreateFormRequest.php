<?php

namespace App\Http\Requests\Order;

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
            'total_price' => 'required|numeric|min:0',
            'shipping_status' => 'required|string',
            'shipping_address' => 'required|string',
            'payment_method' => 'required|in:credit_card,paypal,cash_on_delivery',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'recipient_name' => 'required|string',
           
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'total_price.required' => 'Vui lòng nhập tổng giá.',
            'shipping_status.required' => 'Vui lòng nhập trạng thái giao hàng.',
            'shipping_address.required' => 'Vui lòng nhập địa chỉ giao hàng.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'phone_number.required' => 'Vui lòng nhập số điện thoại.',
            'recipient_name.required' => 'Vui lòng nhập tên người nhận.',
        ];
    }
}
