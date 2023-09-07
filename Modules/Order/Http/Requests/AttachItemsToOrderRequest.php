<?php

namespace Modules\Order\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachItemsToOrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'items' => [
                'bail', 'required', 'array'
            ],

            'items.*.item_id' => [
                'bail', 'required', 'string',
                'exists:books,id'
            ],

            'items.*.quantity' => [
                'bail', 'required', 'integer'
            ]
        ];
    }

    /**
     * Give names to each attribute in the given
     * array of items
     *
     * @return string[]
     */
    public function attributes()
    {
        return [
            'items.*.item_id' => 'item id',
            'items.*.quantity' => 'quantity'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Complete request for AttachItemsToOrderRequesst

        return true;
    }
}
