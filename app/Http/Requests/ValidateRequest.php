<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name'=>'bail|required',
            'email' => 'bail|required|email',
            'password' => 'bail|required|min:4',
            'isActive' => ''

        ];
    }
    public function messages()
    {
        return [

            'required' => '完全に入力してください',
            'min' => '無効な長さ',
        ];
    }
}
