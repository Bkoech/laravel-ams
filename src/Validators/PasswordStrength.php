<?php

namespace Wilgucki\LaravelAms\Validators;

class PasswordStrength
{
    public function validate($attribute, $value)
    {
        $validGroups = 0;

        if (preg_match('/\pL/', $value)) {
            $validGroups++;
        }

        if (preg_match('/\pN/', $value)) {
            $validGroups++;
        }

        if (preg_match('/(\p{Ll}+.*\p{Lu})|(\p{Lu}+.*\p{Ll})/', $value)) {
            $validGroups++;
        }

        if (preg_match('/[!@#$%^&*?()\-_=+{};:,<.>]/', $value)) {
            $validGroups++;
        }

        if ($validGroups < 3) {
            return false;
        }

        return true;
    }
}
