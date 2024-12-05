<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'email' => 'required|string|email',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng điền tên người dùng.',
            'email.required' => 'Vui lòng điền email.',
            'email.email' => 'Định dang email không hợp lệ, vui nhập lại (ví dụ: name@example.com).',
            'phone.required' => 'Vui lòng điền số điện thoại.',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 chữ số.',
        ];
    }
}
