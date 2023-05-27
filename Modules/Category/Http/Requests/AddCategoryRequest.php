<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'bail', 'required', 'unique:categories,category',
                'string', 'max:50'
            ],

            'description' => [
                'bail', 'nullable', 'string',
                'max:250'
            ],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Complete request for AddCategoryRequest

        return true;
    }
}
