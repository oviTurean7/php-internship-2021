<?php

namespace App\Controllers;

class TestController extends BaseController
{
    public function test()
    {

//        $data = require_once "../data/products.php";

//        var_dump($GLOBALS["dataPath"]);

//        exit();
//        echo $GLOBALS["dataPath"] . '/products';
           $data = require_once dataPath() . "/products.php";






        $this->bladeResponse($data, 'products/list');
//        $this->jsonResponse($data);
//        $this->response($data, 'products/list');
    }
}
