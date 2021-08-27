<?php

namespace App\Validations;

class InputValidator
{
    public function validate($rules, $request, $messages)
    {
        foreach ($rules as $rule) {
            if(!filter_var($request['email'], $rule)) {
                return $messages['emailError'];
            }
        }

        return true;
    }

    public function getErrors()
    {

    }
}