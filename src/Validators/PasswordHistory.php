<?php

namespace Wilgucki\LaravelAms\Validators;

use Wilgucki\LaravelAms\Models\PasswordHistory as PassHistory;

class PasswordHistory
{
    public function validate($attribute, $value, $parameters)
    {
        $passwords = PassHistory::where($parameters[0], $parameters[1])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $passwordExists = false;

        foreach ($passwords as $password) {
            if (\Hash::check($value, $password->password)) {
                $passwordExists = true;
                break;
            }
        }

        return !$passwordExists;
    }
}
