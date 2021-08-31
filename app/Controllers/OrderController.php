<?php

namespace App\Controllers;

use App\Repositories\Categories;


use App\Repositories\Products;
use App\Validators\Validator;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\MySQL;
use Dompdf\Dompdf;


class OrderController extends BaseController implements ResourceControllerInterface
{
    //protected $categoryRepo;


    public function view()
    {
        $this->bladeResponse(array('Ioana' => 1), 'products/orders');
    }

    public function index()
    {

        $config = ['host' => 'localhost',
            'port' => '3306',
            'username' => 'root',
            'password' => '',
            'database' => 'ecommerce'];

        $dt = new Datatables(new MySQL($config));

        $dt->query("Select id, total_price, first_name, last_name, email, address, image_url from `orders`");

        echo $dt->generate();

    }

    public function getItems($id) {
        $config = ['host' => 'localhost',
            'port' => '3306',
            'username' => 'root',
            'password' => '',
            'database' => 'ecommerce'];

        $dt = new Datatables(new MySQL($config));

        $dt->query("Select id, product_id, order_id, number_of_units, price from `order_items` WHERE order_id='$id'");

        echo $dt->generate();
        //return $dt->generate();
    }


    public function show($id)
    {

        //echo $id;
        /*
        global $conn;
        //global $categories;
        $sql = "SELECT * FROM `orders` WHERE id= '$id'";
        $result = $conn->query($sql);
        $category = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($category);*/
        global $order;
        global $conn;
        $sql = "SELECT * FROM `orders` WHERE id= '$id'";
        $result = $conn->query($sql);
        $order = $result->fetch_all(MYSQLI_ASSOC);
        $data1['order'] = $order[0];
        //var_dump($data1['order'] );
        $this->bladeResponse($data1, 'products/order-details');

    }

    public function create()
    {

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

    }

    public function pdf($id)
    {

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        global $conn;
        $sql = "SELECT * FROM `orders` WHERE id= '$id'";
        $result = $conn->query($sql);
        $order = $result->fetch_all(MYSQLI_ASSOC);
        $data1['order'] = $order[0];
        //echo $id;
        //var_dump($order);
        $result = $conn->query("Select id, product_id, order_id, number_of_units, price from `order_items` WHERE order_id='$id'");


        $data1['items'] = $result->fetch_all(MYSQLI_ASSOC);
        //var_dump($data1['items']);

        for ($index = 0; $index < count($data1['items']); $index++) {
            $data1['items'][$index]['product_name'] = Products::getProductById($data1['items'][$index]["product_id"])["name"];
           // $data1['items'][$index]['product_name'] = "ana";

        }

        //$this->bladeResponse($data1, 'products/order-pdf');

        $result = $this->bladeRenderer->render('products/order-pdf', $data1);
//        $result .= "<link rel=\"stylesheet\" href=\"C:\\xampp\\htdocs\\assignment\\public\\styles\\styles.css\" media=\"all\" />";
        $dompdf->loadHtml($result);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait'); //or landscape
        // Render the HTML as PDF

        $dompdf->render();

        $output = $dompdf->output();
        file_put_contents(publicPath() . "/order_$id.pdf", $output);
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=\"order_$id.pdf\"");
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize(publicPath() . "/order_$id.pdf"));
        header('Accept-Ranges: bytes');
        header("Content-Disposition:attachment;filename=order$id.pdf");

       // readfile("order_$id.pdf");
      //  readfile(publicPath() . "/order_$id.pdf");


    }

    public function download($id) {
        header('Content-type: application/pdf');
        header("Content-Disposition: inline; filename=\"order_$id.pdf\"");
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize(publicPath() . "/order_$id.pdf"));
        header('Accept-Ranges: bytes');
        header("Content-Disposition:attachment;filename=order$id.pdf");

        readfile("order_$id.pdf");
        readfile(publicPath() . "/order_$id.pdf");
        //header("Location: http://php.local/");
    }

    public function delete($id)
    {
        global $conn;

        $stmt = $conn->prepare("DELETE FROM orders WHERE id='$id'");


        $stmt->execute();
        $stmt->close();
    }
}