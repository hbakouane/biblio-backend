<?php

namespace Modules\User\Http\Requests\Auth\Signup;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => [
                'bail', 'required', 'string',
                'max:30'
            ],
            'last_name' => [
                'bail', 'required', 'string',
                'max:30'
            ],
            'full_name' => [
                'bail', 'required', 'string',
                'max:60'
            ],
            'email' => [
                'bail', 'required', 'email',
                'unique:users'
            ],
            'password' => [
                'bail', 'required', 'string',
                'min:8', 'confirmed'
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
        // TODO: Complete request for RegisterRequest

        return true;
    }
}
