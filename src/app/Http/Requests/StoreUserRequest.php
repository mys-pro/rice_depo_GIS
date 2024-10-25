<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            ],
            'confirm' => 'required|string|same:password',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'birthday' => 'required|date',
            'warehouse_id' => 'required|integer|gt:0',
            'address' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng điền tên người dùng.',
            'email.required' => 'Vui lòng điền email.',
            'email.email' => 'Định dang email không hợp lệ, vui nhập lại (ví dụ: name@example.com).',
            'password.required' => 'Vui lòng điền mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.',
            'confirm.required' => 'Nhập lại mật khẩu không được để trống.',
            'confirm.same' => 'Mật khẩu không trùng khớp.',
            'phone.required' => 'Vui lòng điền số điện thoại.',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 chữ số.',
            'birthday.required' => 'Vui lòng điện ngày sinh.',
            'birthday.date' => 'Ngày sinh không hợp lệ.',
            'warehouse_id.required' => 'Vui lòng chọn kho.',
            'warehouse_id.gt' => 'Vui lòng chọn kho.',
            'address.required' => 'Vui lòng điền địa chỉ.'
        ];
    }
}
