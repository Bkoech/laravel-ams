<?php

namespace Wilgucki\LaravelAms\Requests;

use App\Http\Requests\Request;

class SaveAdminRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'name' => 'required|max:250',
            'email' => 'required|email|unique:admins',
            'role_id' => 'required'
        ];

        if ($this->route('admin') !== null) {
            $rules['email'] .= ',email,'.$this->route('admin');
        }

        if ($this->route('admin') === null) {
            $rules['password'] = 'required|confirmed|password_strength|min:8';
        } elseif ($this->request->get('password')) {
            $rules['password'] = 'required|confirmed|password_strength|min:8|password_history:admin_id,'
                .$this->route('admin');
        }

        return $rules;
    }
}
