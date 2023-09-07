<?php

namespace Modules\Book\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewBookRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'bail', 'required', 'string',
                'max:100'
            ],

            'author' => [
                'bail', 'required', 'string',
                'max:100'
            ],

            'excerpt' => [
                'bail', 'nullable', 'string',
                'max:120'
            ],

            'description' => [
                'bail', 'nullable', 'string',
                'max:10000'
            ],

            'category_id' => [
                'bail', 'required', 'string',
                'exists:categories,id'
            ],

            'price' => [
                'bail', 'required', 'numeric'
            ],

            'quantity '=> [
                'bail', 'required', 'string'
            ],

            'publisher_id' => [
                'bail', 'required', 'string',
                'exists:profiles,id'
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
        // TODO: Complete request for AddNewBookRequest

        return true;
    }
}
