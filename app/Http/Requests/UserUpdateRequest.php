<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'username' => 'min:2|required',
            'last_name' => 'min:2|required',
            'first_name' => 'min:2|required',
            'password' => '',
            'password_confirmation' => '',
            'email' => 'min:6|required',
        ];
    }
}
