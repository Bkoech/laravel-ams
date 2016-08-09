<?php

namespace Wilgucki\LaravelAms\Requests;

use App\Http\Requests\Request;

class UploadModuleRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'module_package' => 'required|file|mimes:zip'
        ];
    }
}
