<?php

namespace App\Controllers;

use App\DAL\DBConnection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExcelController extends BaseController
{
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

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $writer->save(basePath() . '/products.csv');
    }

    public function importTemplate()
    {
        $sheet = basePath() . "/public/import-template.csv";

        if (file_exists($sheet)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($sheet));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($sheet));
            ob_clean();
            flush();
            readfile($sheet);
            exit();
        }
    }

    public function importData()
    {
        $reader = '';

        if ($_FILES['file']['size'] < 2000000) {
            $type = substr($_FILES['file']['name'], strpos($_FILES['file']['name'], '.') + 1);

            if ($type === 'csv') {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            }
            elseif ($type === 'xls' || $type === 'xlsx') {
                $reader =  IOFactory::createReaderForFile($_FILES['file']['tmp_name']);
                $reader->setReadDataOnly(true);
            }
            else {
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            }

            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            $result = $spreadsheet->getActiveSheet()->toArray();
            array_shift($result);

            $query = '';
            foreach ($result as $product) {
                $name = $product[1]; //without id
                $price = $product[2];
                $description = $product[3];
                $units = $product[4];
                $category_id = $product[5];
                $query .= "INSERT INTO `products`(`name`, `price`, `description`, `units`, `category_id`) VALUES('$name', '$price', '$description', '$units', '$category_id');";
            }

            $conn = new DBConnection();
            $conn->insertMultipleData($query);

            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    }
}