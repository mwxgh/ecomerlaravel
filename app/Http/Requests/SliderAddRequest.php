<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name'=>'required|unique:sliders|max:255|min:5',
            'description'=>'required',
            'image_path'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập đầy đủ tên slider',
            'name.unique' => 'Tên không được phép trùng với slider khác',
            'name.max'=>'Tên không được phép quá dài',
            'name.min'=>'Vui lòng nhập slider đủ dài 5 ký tự',
            'description.required'=>'Vui lòng nhập mô tả slider',
            'image_path.required'=>'Vui lòng chọn một ảnh',
        ];
    }
}
