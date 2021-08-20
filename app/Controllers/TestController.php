<?php

namespace App\Controllers;
class TestController extends BaseController
{
    public function test()
    {
        include 'C:\xampp\htdocs\PHP Training\data\products.php';

        if (isset($data)) {
            $this->bladeResponse($data, 'products/list');
        }

    }
    public function cart()
    {
        include 'C:\xampp\htdocs\PHP Training\data\products.php';

        if (isset($data)) {
            $this->bladeResponse($data, 'products/cart');
        }

    }
}
