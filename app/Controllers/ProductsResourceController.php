<?php

namespace App\Controllers;

require_once basePath() . '/vendor/autoload.php';

use App\DAL\DBConnection;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProductsResourceController extends BaseController implements ResourceControllerInterface
{
    public function root()
    {
        $this->bladeResponse([], 'products/products');
    }

    public function index()
    {
        $conn = new DBConnection();
        $result = $conn->getData("SELECT id, name, price, description, units, category_id FROM products");

        echo '{"data": ' . json_encode($result) . '}';
    }

    public function editorIndex()
    {
        if (isset($_REQUEST) && $_REQUEST['action'] == "create") {
            return $this->store();
        } elseif (isset($_REQUEST) && $_REQUEST['action'] == "remove") {
            $id = array_keys($_POST['data'])[0];
            return $this->delete($id);
        } elseif (isset($_POST['data'])) {
            $id = array_keys($_POST['data'])[0];
            return $this->update($id);
        }
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function store()
    {
        $conn = new DBConnection();
        $name = $_POST['data'][0]['name'];
        $price = $_POST['data'][0]['price'];
        $description = $_POST['data'][0]['description'];
        $units = $_POST['data'][0]['units'];
        $category_id = $_POST['data'][0]['category_id'];

        return $conn->insertData("INSERT INTO `products`(`name`, `price`, `description`, `units`, `category_id`) VALUES('$name', '$price', '$description', '$units', '$category_id')");
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update($id)
    {
        $conn = new DBConnection();
        $name = $_POST['data'][$id]['name'];
        $price = $_POST['data'][$id]['price'];
        $description = $_POST['data'][$id]['description'];
        $units = $_POST['data'][$id]['units'];
        $category_id = $_POST['data'][$id]['category_id'];

        $query = "UPDATE `products` SET `name`='$name', `price`='$price', `description`='$description', `units`='$units', `category_id`='$category_id' WHERE `id`=$id";
        return $conn->updateData($query);
    }

    public function delete($id)
    {
        $conn = new DBConnection();
        return $conn->deleteData('products', $id);
    }

    public function export()
    {
        $conn = new DBConnection();
        $products = $conn->getData("SELECT id, name, price, description, units, category_id FROM products");
        $headers = array_keys($products[0]);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($headers, NULL, 'A1');

        for ($i = 0; $i < count($products); $i++) {
            $row = $i + 2;
            $sheet->fromArray($products[$i], NULL, 'A' . $row);
        }

//        header('Content-Disposition: attachment;filename="products.csv"');
//        header("Content-Type: application/octet-stream");
//        header("Connection: close");

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $writer->save(basePath() . '/products.csv');

    }
}