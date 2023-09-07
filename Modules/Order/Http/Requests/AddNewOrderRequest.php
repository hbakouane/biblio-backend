<?php

namespace Modules\Order\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => [
                'bail', 'required', 'string',
                'exists:profiles,id'
            ],

            'total' => [
                'bail', 'required', 'numeric'
            ],

            'note' => [
                'nullable', 'string', 'max:120'
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
        // TODO: Complete request for AddNewOrderRequest

        return true;
    }
}
