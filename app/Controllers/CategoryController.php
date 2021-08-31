<?php

namespace App\Controllers;

require_once basePath() . '/vendor/autoload.php';

use App\DAL\DBConnection;

class CategoryController extends BaseController implements ResourceControllerInterface
{
    public function root()
    {
        $this->bladeResponse([], 'products/categories');
    }

    public function index()
    {
        $conn = new DBConnection();
        $result = $conn->getData("SELECT id, name, briefing FROM category");

        echo '{"data": ' . json_encode($result) . '}';
    }

    public function editorIndex()
    {
        if (isset($_REQUEST) && $_REQUEST['action'] == "create") {
            return $this->store();
        }
        elseif (isset($_REQUEST) && $_REQUEST['action'] == "remove") {
            $id = array_keys($_POST['data'])[0];
            return $this->delete($id);
        }
        elseif (isset($_POST['data'])) {
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
        $briefing = $_POST['data'][0]['briefing'];
        return $conn->insertData("INSERT INTO `category`(`name`, `briefing`) VALUES('$name', '$briefing')");
    }

    public function edit($id)
    {
    }

    public function update($id)
    {
        $conn = new DBConnection();
        $name = $_POST['data'][$id]['name'];
        $briefing = $_POST['data'][$id]['briefing'];

        $query = "UPDATE `category` SET `name`='$name', `briefing`='$briefing' WHERE `id`=$id";
        return $conn->updateData($query);
    }

    public function delete($id)
    {
        $conn = new DBConnection();
        return $conn->deleteData('category', $id);
    }
}