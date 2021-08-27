<?php

namespace App\Controllers;

require_once basePath() . '/vendor/autoload.php';

use App\DAL\DBConnection;
use Ozdemir\Datatables\Datatables;
use Ozdemir\Datatables\DB\MySQL;

class CategoryController extends BaseController implements ResourceControllerInterface
{
    public function root()
    {
        $this->bladeResponse([], 'products/categories');
    }

    public function index()
    {
        $dt = new Datatables(new MySQL(getDatatablesConfig()));
        $dt->query("SELECT id, name, briefing FROM category");

        echo $dt->generate();
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
        $dt = new Datatables(new MySQL(getDatatablesConfig()));
        $dt->edit('name', function($data){
            return $data['name'] . 'X';
        });
    }

    public function update($id)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}