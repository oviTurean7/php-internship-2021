<?php

namespace App\Controllers;

use App\Repositories\Products;
use App\Validators\Validator;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\MySQL;

class ProductController extends BaseController implements ResourceControllerInterface
{
    public function sortColumn() {
//        var_dump($_REQUEST);
//        echo json_decode($_POST['column']);
//        echo 'ddddddddddddddddddddddaaaaaaaaaaaaaa';
        $_SESSION['column'] = $_POST['column'];
        if (isset($_COOKIE['date'])) {
            var_dump( $_COOKIE['date']);
        }

        //echo $_POST['column'];
    }

    public function view() {
        $this->bladeResponse(array('Ioana' => 1), 'products/products');
    }

    public function addProducts() {
        Products::addProductsToDatabase();
    }

    public function sortDirection() {
        if($_POST['direction'] === "down") {
            $_SESSION['direction'] = "desc";
        }
        else {
            $_SESSION['direction'] = "asc";
        }

        if (isset($_COOKIE['date'])) {
            var_dump( $_COOKIE['date']);
        }
    }

    public function index()
    {
        $config = [ 'host'     => 'localhost',
            'port'     => '3306',
            'username' => 'root',
            'password' => '',
            'database' => 'ecommerce' ];

        $dt = new Datatables( new MySQL($config) );

        $dt->query("Select id, name, units, price, description, url, category_id from `products`");

        echo $dt->generate();
    }

    public function show($id)
    {
        global $conn;
        //global $categories;
        $sql = "SELECT * FROM `products` WHERE id= '$id'";
        $result = $conn->query($sql);
        $product = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($product);
    }

    public function create()
    {
        $rules = [];
        foreach ($_POST as $key => $item) {
            if ($key === 'email')
            {
                $rules[$key] = 'email';
            }
            else
            {
                $rules[$key] = 'required';
            }
        }
        $validator = new Validator($rules, $_POST, []);
        if($validator->evaluate() === false)
        {
            echo implode (", ", $validator->getErrors());
            http_response_code(404);
            return;
        }
        global $conn;
        //global $categories;
        $sql = "SELECT id FROM `categories`";
        $result = $conn->query($sql);
        $categories = $result->fetch_all(MYSQLI_NUM);;
        var_dump($categories);
        var_dump($_POST['categoryId']);
        if (!in_array(array(strval($_POST['categoryId'])), $categories))
        {
            echo "The category does not exist";
            http_response_code(404);
            return;
        }

        $stmt = $conn->prepare("INSERT  INTO products(name, units, price, description, url, category_id) VALUES (?, ?, ?, ?, ?, ?)");

        $stmt->bind_param("sidssi", $name, $units, $price, $description, $url, $categoryId);
        $name = $_POST['name'];
        $units = $_POST['units'];
        $price =  $_POST['price'];
        $description =  $_POST['description'];
        $url = $_POST['url'];
        $categoryId = $_POST['categoryId'];
        $stmt->execute();
        $stmt->close();
    }

    public function store()
    {
        // TODO: Implement store() method.
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update($id)
    {
        parse_str(file_get_contents("php://input"), $_PUT);
        $rules = [];
        foreach ($_PUT as $key => $item) {
            if ($key === 'email')
            {
                $rules[$key] = 'email';
            }
            else
            {
                $rules[$key] = 'required';
            }
        }
        $validator = new Validator($rules, $_PUT, []);
        if($validator->evaluate() === false)
        {
            echo implode (", ", $validator->getErrors());
            http_response_code(404);
            return;
        }
        global $conn;

        $name = $_PUT['name'];
        $units = $_PUT['units'];
        $price =  $_PUT['price'];
        $description =  $_PUT['description'];
        $url = $_PUT['url'];
        $categoryId = $_PUT['categoryId'];
        $stmt = $conn->prepare("UPDATE products SET name='$name', units='$units', price='$price',description='$description',url='$url',category_id='$categoryId' WHERE id='$id'");



        $stmt->execute();
        $stmt->close();
    }

    public function delete($id)
    {
        global $conn;

        $stmt = $conn->prepare("DELETE FROM products WHERE id='$id'");



        $stmt->execute();
        $stmt->close();
    }
}