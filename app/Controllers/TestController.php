<?php

namespace App\Controllers;

session_start();

class TestController extends BaseController
{
    public function test()
    {
        $data = [
            'username' => 'andrei.test',
            'firstName' => 'Andrei',
            'lastName' => 'Arba',
            'products' => [
                [
                    'id' => 3,
                    'name' => 'item 1',
                    'units' => 2,
                    'price' => 150,
                    'description' => 'Best product on the market'
                ],
                [
                    'id' => 2,
                    'name' => 'item 2',
                    'units' => 200,
                    'price' => 5,
                    'description' => 'Just a cheap product with large stock'
                ],
                [
                    'id' => 1,
                    'name' => 'item 3',
                    'units' => 20,
                    'price' => 45,
                    'description' => 'An average, affordable product'
                ],
            ]
        ];


        $this->bladeResponse($data, 'products/list');
//        $this->jsonResponse($data);
//        $this->response($data, 'products/list');
    }

    public function showProducts()
    {
        $products = include_once basePath() . '/data/products.php';
        if(isset($_REQUEST['column'])) {
            usort($products, function ($p1, $p2) {
                $directionSort = $_SESSION['columns'][$_REQUEST['column']] == 'asc' ? -1 : 1;
                if($p1[$_REQUEST['column']] < $p2[$_REQUEST['column']]) return $directionSort;

                return -1 * $directionSort;
            });
        }
        $this->bladeResponse(array('products' => $products), 'products/table');
    }
}
