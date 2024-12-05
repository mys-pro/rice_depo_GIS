<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|string|email',
            'phone' => 'required|regex:/^0[0-9]{9}$/',
            'birthday' => 'required|date',
            // 'warehouse_id' => 'required|integer|gt:0',
            'address' => 'required|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->has('warehouse_id') && empty($this->warehouse_id)) {
                $validator->errors()->add('old_password', 'Vui lòng chọn kho.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Vui lòng điền tên người dùng.',
            'image.image' => 'Vui lòng chọn ảnh.',
            'image.mimes' => 'Định dạng ảnh không hợp lệ (Ví du: *.jpeg, *.png, *.jpg, *gif).',
            'image.max' => 'Kích thước ảnh quá lớn.',
            'email.required' => 'Vui lòng điền email.',
            'email.email' => 'Định dang email không hợp lệ, vui nhập lại (ví dụ: name@example.com).',
            'phone.required' => 'Vui lòng điền số điện thoại.',
            'phone.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 chữ số.',
            'birthday.required' => 'Vui lòng điện ngày sinh.',
            'birthday.date' => 'Ngày sinh không hợp lệ.',
            'address.required' => 'Vui lòng điền địa chỉ.'
        ];
    }
}
