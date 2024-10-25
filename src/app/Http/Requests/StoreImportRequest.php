<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImportRequest extends FormRequest
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
            'customer_id' => 'required|integer|gt:0',
            'inputs' => 'required|array',
            'inputs.*.rice_id' => 'required|gt:0',
            'inputs.*.quantity' => 'required|min:1',
            'inputs.*.price' => 'required|numeric|gte:1000'
        ];
    }

    protected function prepareForValidation()
    {
        $inputs = $this->input('inputs');
        if (is_array($inputs)) {
            foreach ($inputs as &$input) {
                if (isset($input['price'])) {
                    $input['price'] = (int) str_replace('.', '', $input['price']);
                }
            }
            $this->merge([
                'inputs' => $inputs,
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Vui lòng chọn khách hàng.',
            'customer_id.gt' => 'Vui lòng chọn khách hàng.',
            'inputs.required' => 'Vui lòng thêm sản phẩm.',
            'inputs.*.rice_id.required' => 'Vui lòng chọn lúa.',
            'inputs.*.rice_id.gt' => 'Vui lòng chọn lúa.',
            'inputs.*.quantity.required' => 'Vui lòng nhập số lượng.',
            'inputs.*.quantity.min' => 'Số lượng phải lớn hơn 1.',
            'inputs.*.price.required' => 'Vui lòng điền số tiền.',
            'inputs.*.price.gte' => 'Số tiền ít nhất là 1.000.',
        ];
    }
}
