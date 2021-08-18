<?php

namespace App\Controllers;

class FileController extends BaseController
{
    function add()
    {

        move_uploaded_file($_FILES['file']['tmp_name'], uploadsPath() . '/' . $_FILES['file']['name']);
    }
}