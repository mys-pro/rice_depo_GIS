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
            'warehouse_id' => 'required|gt:0',
            'customer_id' => 'required|integer|gt:0',
            'inputs' => 'required|array',
            'inputs.*.rice_id' => 'required|gt:0',
            'inputs.*.weight' => 'required|gte:1',
            'inputs.*.price' => 'required|numeric|gte:1000'
        ];
    }

    protected function prepareForValidation()
    {
        $inputs = $this->input('inputs');
        if (is_array($inputs)) {
            foreach ($inputs as $key => $input) {
                if (isset($input['price'])) {
                    $inputs[$key]['price'] = (int) str_replace('.', '', $input['price']);
                }
            }
            $this->merge([
                'inputs' => $inputs,
            ]);
        }
    }

    public function messages(): array
    {
        $messages = [];

        foreach ($this->input('inputs', []) as $index => $input) {
            $messages["inputs.$index.rice_id.required"] = "Vui lòng chọn lúa (" . ($index + 1) . ').';
            $messages["inputs.$index.rice_id.gt"] = "Vui lòng chọn lúa (" . ($index + 1) . ').';
            $messages["inputs.$index.weight.required"] = "Vui lòng nhập khối lượng (" . ($index + 1) . ').';
            $messages["inputs.$index.weight.gte"] = "Khối lượng phải ít nhất là 1 kg (" . ($index + 1) . ').';
            $messages["inputs.$index.price.required"] = "Vui lòng điền số tiền (" . ($index + 1) . ').';
            $messages["inputs.$index.price.gte"] = "Số tiền ít nhất là 1.000 VNĐ (" . ($index + 1) . ').';
        }

        $messages['warehouse_id.required'] = 'Vui lòng chọn kho.';
        $messages['warehouse_id.gt'] = 'Vui lòng chọn kho.';
        $messages['customer_id.required'] = 'Vui lòng chọn khách hàng.';
        $messages['customer_id.gt'] = 'Vui lòng chọn khách hàng.';
        $messages['inputs.required'] = 'Vui lòng thêm sản phẩm.';

        return $messages;
    }
}
