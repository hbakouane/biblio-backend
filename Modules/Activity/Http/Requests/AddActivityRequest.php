<?php

namespace Modules\Activity\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Activity\Entities\Activity;

class AddActivityRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => [
                'bail', 'required', 'exists:users,id'
            ],

            'key' => [
                'bail', 'required', Rule::in(Activity::getAllActivityKeys())
            ],

            'extra' => [
                'bail', 'nullable', 'array'
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
        // TODO: Complete request for AddActivityRequest

        return true;
    }
}
