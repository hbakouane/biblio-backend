<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditCategoryRequest extends FormRequest
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
                'bail', 'nullable', 'unique:categories,category,' . $this->id,
                'string', 'max:50'
            ],

            'description' => [
                'bail', 'nullable', 'string',
                'max:250'
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
        // Add the attribute category as well since we have it our table
        $this->request->add([
            'category' => request()->get('name')
        ]);

        // TODO: Complete request for EditCategoryRequest

        return true;
    }
}
