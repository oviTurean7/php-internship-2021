<?php

namespace App\Validators;

class Validator
{
    private $rules;
    private $request;
    private $messages;
    private $errors;

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    public function __construct($rules, $request, $messages) {
        $this->rules = $rules;
        $this->request = $request;
        $this->messages = $messages;

    }

    public function evaluate () {
        $this->errors = [];

        foreach ($this->rules as $key => $value){
            if($value === 'email')
            {
                if (ValidatorRules::email($this->request[$key]) === false)
                {
                    if (isset($this->messages[$key]))
                        $this->errors[] = $this->messages[$key];
                    else
                        $this->errors[] = 'Invalid email';

                }
            }
            if($value === 'required')
            {
                if (ValidatorRules::required($this->request[$key]) === false)
                {
                    if (isset($this->messages[$key]))
                        $this->errors[] = $this->messages[$key];
                    else
                        $this->errors[] = "Field $key is required";

                }
            }
        }


        if (count($this->errors) === 0)
        {
            return true;
        }
        return false;
    }
}

class ValidatorRules {
    public static function email($email) {
        $pattern = '/(.+@.+\..+)/';
        $res = preg_match($pattern, $email);

        if ($res === 0) {
            return false;

        }
        return true;
    }

    public static function required($data) {

        if ($data == "" || $data == null) {
            return false;

        }
        return true;
    }
}