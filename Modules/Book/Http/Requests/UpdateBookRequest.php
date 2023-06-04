<?php

namespace Modules\Book\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
                'bail', 'nullable', 'string',
                'max:100'
            ],
            'author' => [
                'bail', 'nullable', 'string',
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
                'bail', 'nullable', 'string',
                'exists:categories,id'
            ],
            'price' => [
                'bail', 'nullable', 'numeric'
            ],
            'quantity '=> [
                'bail', 'nullable', 'numeric'
            ],
            'publisher_id' => [
                'bail', 'nullable', 'string',
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
        // TODO: Complete request for UpdateBookRequest

        return true;
    }
}
