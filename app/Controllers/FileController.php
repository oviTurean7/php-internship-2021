<?php

namespace App\Controllers;

class FileController extends BaseController
{
    static function add()
    {

        move_uploaded_file($_FILES['file']['tmp_name'], uploadsPath() . '/' . $_FILES['file']['name']);
    }

    static function append($data) {
        $file= fopen(dataPath() . "/orders.txt", "a+") or die("Unable to
open file!");
        file_put_contents(dataPath() . "/orders.txt", implode(", ", $data));
        fclose($file);

    }
}