<?php

namespace App\Validations;

class InputValidator
{
    private $errorMessages;
    public function validate($rules, $request, $messages)
    {
        foreach ($rules as $rule) {
            if(!filter_var($request['email'], $rule)) {
                $this->errorMessages[] = $messages['emailError'];
                return false;
            }
        }

        return true;
    }

    public function getErrors()
    {
        return $this->errorMessages;
    }
}