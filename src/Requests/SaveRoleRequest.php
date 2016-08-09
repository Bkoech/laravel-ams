<?php

namespace Wilgucki\LaravelAms\Requests;

use App\Http\Requests\Request;

class SaveRoleRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:250',
        ];
    }
}
