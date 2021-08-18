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
//        $this->jsonResponse($data);
//        $this->response($data, 'products/list');

    }
}
