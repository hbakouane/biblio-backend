<?php

namespace Modules\User\Http\Requests\Auth\Login;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => [
                'bail', 'required', 'email'
            ],

            'password' => [
                'bail', 'required', 'string'
            ],

            'remember_me' => [
                'bail', 'required', 'boolean'
            ]
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Complete request for LoginRequest

        return true;
    }
}
