<?php

namespace App\Controllers;

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

    public function testDB() {
        $this->bladeResponse([],'dbTest/testDB');
    }

    public function showUsers() {
        $path = '/public/database/';

        if (isset($_REQUEST['type'])) {
            switch ($_REQUEST['type']) {
                case 'proced': $path .= 'mysqli-procedural.php'; break;
                case 'oop': $path .= 'mysqli-oop.php'; break;
                case 'pdo': $path .= 'pdo.php'; break;
            }
            $rows = include_once basePath() . $path;
            $this->bladeResponse(array('users' => $rows), 'dbTest/userList');
        }
    }
}
