<?php

namespace App\Controllers;

use App\Repositories\Categories;


use App\Validators\Validator;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\MySQL;


class CategoryController extends BaseController implements ResourceControllerInterface
{
    protected $categoryRepo;


    public function view() {
        $this->bladeResponse(array('Ioana' => 1), 'products/categories');
    }

    public function index()
    {

        $config = [ 'host'     => 'localhost',
            'port'     => '3306',
            'username' => 'root',
            'password' => '',
            'database' => 'ecommerce' ];

        $dt = new Datatables( new MySQL($config) );

        $dt->query("Select id, name, briefing from `categories`");

        echo $dt->generate();

    }


    public function show($id)
    {
        //echo $id;
        global $conn;
        //global $categories;
        $sql = "SELECT * FROM `categories` WHERE id= '$id'";
        $result = $conn->query($sql);
        $category = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($category);

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


        $stmt = $conn->prepare("INSERT  INTO categories(name, briefing) VALUES (?, ?)");

        $stmt->bind_param("ss", $name, $briefing);
        $name =  $_POST['name'];
        $briefing =  $_POST['briefing'];
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

        $name =  $_PUT['name'];
        $briefing =  $_PUT['briefing'];
        $stmt = $conn->prepare("UPDATE categories SET name='$name', briefing='$briefing' WHERE id='$id'");



        $stmt->execute();
        $stmt->close();
    }

    public function delete($id)
    {
        global $conn;

        $stmt = $conn->prepare("DELETE FROM categories WHERE id='$id'");



        $stmt->execute();
        $stmt->close();
    }
}