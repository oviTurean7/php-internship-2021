<?php

namespace App\Controllers;

use App\Repositories\Products;

class TestController extends BaseController
{
    public function test()
    {

//        $data = require_once "../data/products.php";

//        var_dump($GLOBALS["dataPath"]);

//        exit();
//        echo $GLOBALS["dataPath"] . '/products';
        $products = new Products();
        $data1['products'] = $products->getProducts();
        //var_dump($data1);

        $data = require dataPath() . "/products.php";
        //var_dump($data);


        $this->bladeResponse($data1, 'products/list');
//        $this->jsonResponse($data);
//        $this->response($data, 'products/list');
    }
}
