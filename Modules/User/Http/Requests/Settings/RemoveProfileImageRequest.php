<?php

namespace Modules\User\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class RemoveProfileImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: Complete request for RemoveProfileImageRequest

        return true;
    }
}
