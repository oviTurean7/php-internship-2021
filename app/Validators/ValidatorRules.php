<?php

namespace App\Validators;

class ValidatorRules
{
    public static function email($email)
    {
        $pattern = '/(.+@.+\..+)/';
        $res = preg_match($pattern, $email);

        if ($res === 0) {
            return false;

        }
        return true;
    }

    public static function required($data)
    {

        if ($data == "" || $data == null) {
            return false;

        }
        return true;
    }

    public static function fileRequired($file)
    {

        if (!file_exists($file)) {
            return false;

        }
        return true;
    }

    public static function fileExtension($file)
    {

        $extension = pathinfo($file, PATHINFO_EXTENSION);
        if ($extension != "csv" && $extension != "xls" && $extension != "xlsx") {
            return false;
        }

        return true;
    }

    public static function fileSize($file)
    {

        $size = filesize($file);
        if ($size > 2097152) {
            return false;
        }
        return true;
    }
}