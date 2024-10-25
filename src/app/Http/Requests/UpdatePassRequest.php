<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UpdatePassRequest extends FormRequest
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
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            ],
            'confirm' => 'required|string|same:password',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->has('old_password') && empty($this->old_password)) {
                $validator->errors()->add('old_password', 'Vui lòng nhập mật khẩu cũ.');
            } elseif ($this->filled('old_password') && !Hash::check($this->old_password, Auth::user()->password)) {
                $validator->errors()->add('old_password', 'Mật khẩu cũ không đúng.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Vui lòng điền mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.regex' => 'Mật khẩu phải bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.',
            'confirm.required' => 'Nhập lại mật khẩu không được để trống.',
            'confirm.same' => 'Mật khẩu không trùng khớp.',
        ];
    }
}
