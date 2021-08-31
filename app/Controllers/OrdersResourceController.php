<?php

namespace App\Controllers;

use App\DAL\DBConnection;

class OrdersResourceController extends BaseController implements ResourceControllerInterface
{

    public function root()
    {
        $this->bladeResponse([], 'products/orders');
    }

    public function index()
    {
        $conn = new DBConnection();
        $orders = $conn->getData("SELECT id, date, total_price FROM orders");
        for($i = 0; $i < count($orders); $i++) {
            $orderID = $orders[$i]['id'];
            $orderItems = $conn->getData("SELECT id, product_id, units_num, price, order_id FROM order_items WHERE order_id = $orderID");
            $orders[$i]['items'] = $orderItems;
        }

        echo '{"data": ' . json_encode($orders) . '}';
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
        // TODO: Implement store() method.
    }

    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        $id = array_keys($_POST['data'])[0];
        $conn = new DBConnection();
        return $conn->deleteData('orders', $id);
    }
}