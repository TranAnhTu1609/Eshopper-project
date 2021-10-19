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
            'name'=>'bail|required|unique:sliders|max:255|min:5',
            'description'=>'required',
            'image_path'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên slider không được để trống',
            'name.unique'=>'Tên slider không được trùng',
            'name.max'=>'Tên slider không được vượt quá 255 kí tự',
            'name.min'=>'Tên slider không được ít hơn 5 kí tự',
            'description.required'=>'Giá khống được để trống',
            'image_path.required'=>'File ảnh không được để trống',
        ];
    }
}
