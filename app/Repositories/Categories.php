<?php

namespace App\Repositories;

class Categories
{

    private $categories;

    public function __construct() {

        global $conn;
        //global $categories;
        $sql = "SELECT * FROM `categories`";
        $result = $conn->query($sql);

        $this->categories = $result->fetch_all(MYSQLI_ASSOC);
    }
    public function getAll() {
        return $this->categories;
    }

}