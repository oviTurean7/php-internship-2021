<?php

namespace App\Controllers;


class ConfirmController extends BaseController
{
    public function confirm () {
        //var_dump($_GET['token']);
        $token = $_GET['token'];
        global $conn;
        $sql = "SELECT id FROM users WHERE token =  '$token'";

        $result = $conn->query($sql);
        //var_dump($result->fetch_assoc());
        if ($result->num_rows === 0) {
            //echo 'tzeapa';
            header("LOCATION: http://php.local");
            //$this->bladeResponse([], 'products/list');
        }
        $id = $result->fetch_assoc()['id'];
        $sql = "UPDATE users SET confirmed = 1 WHERE id = '$id'";
        //echo $sql;
        $result = $conn->query($sql);

        //echo $result;
        header("LOCATION: http://php.local");
        //$this->bladeResponse([], 'products/list');
        //$this->bladeResponse(array('Ioana' => 1), 'products/list');



    }
}