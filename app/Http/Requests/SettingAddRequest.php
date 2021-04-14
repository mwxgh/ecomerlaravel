<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'config_key'=>'required|unique:settings|max:255',
            'config_value'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'config_key.required' => 'Vui lòng nhập đầy đủ khóa config',
            'config_key.unique' => 'Config không được phép trùng với config khác',
            'name.max'=>'Config không được phép quá dài',
            'config_value.required'=>'Vui lòng nhập giá trị config',
        ];
    }
}
