<?php

namespace Modules\User\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Core\Entities\Core;

class UploadProfileImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image' => [
                'bail', 'required', 'file',
                'mimes:' . implode(',', Core::$allowedImageExtension)
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
        // TODO: Complete request for UploadProfileImageRequest

        return true;
    }
}
