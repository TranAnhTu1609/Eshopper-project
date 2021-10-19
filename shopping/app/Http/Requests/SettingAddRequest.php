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
            'config_key'=>'bail|required|unique:settings|max:255|min:5',
            'config_value'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'config_key.required'=>'Key không được để trống',
            'config_key.unique'=>'Key không được trùng',
            'config_key.max'=>'Key không được vượt quá 255 kí tự',
            'config_key.min'=>'Key không được ít hơn 5 kí tự',
            'config_value.required'=>'Value không được để trống'
        ];
    }

}
