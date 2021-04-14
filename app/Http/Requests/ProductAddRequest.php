<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name'=>'bail|required|unique:products,name|max:255|min:5',
            //unique:table,column not coincident
            'price'=>'required',
            'category_id'=>'required',
            'contents'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập đầy đủ tên sản phẩm',
            'name.unique' => 'Tên không được phép trùng với sản phẩm khác',
            'name.max'=>'Tên không được phép quá dài',
            'name.min'=>'Vui lòng nhập tên đủ dài 5 ký tự',
            'price.required'=>'Vui lòng nhập giá sản phẩm',
            'category_id.required'=>'Vui lòng nhập danh mục sản phẩm',
            'contents.required'=>'Vui lòng nhập nội dung sản phẩm đầy đủ'
        ];
    }
}
