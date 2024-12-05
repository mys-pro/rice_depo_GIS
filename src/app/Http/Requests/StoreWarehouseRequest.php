<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWarehouseRequest extends FormRequest
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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'address' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'Vui lòng chọn ảnh.',
            'image.mimes' => 'Định dạng ảnh không hợp lệ (Ví du: *.jpeg, *.png, *.jpg, *gif).',
            'image.max' => 'Kích thước ảnh quá lớn.',
            'name.required' => 'Vui lòng nhập tên kho.',
            'longitude.required' => 'Vui lòng nhập kinh độ.',
            'latitude.required' => 'Vui lòng nhập vĩ độ.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
        ];
    }
}