<?php

namespace App\Controllers;

class RegexController extends BaseController
{
    public function solve() {
        echo '1.: ';
        $pattern = '/(.+@.+\..+)/';
        $subject = 'a@m.c';
        $result = preg_match($pattern, $subject);
        echo $result;

        echo "<br>2.: ";
        $pattern = '/(\+407\d{8})/';
        $subject = '+40723098987';
        $macthes = [];
        preg_match($pattern, $subject, $macthes);
        echo $macthes[0];
    }
}