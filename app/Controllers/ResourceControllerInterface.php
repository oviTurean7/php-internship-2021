<?php

namespace App\Controllers;


interface ResourceControllerInterface
{
    public function index();
    public function show($id);
    public function create();
    public function store();
    public function edit($id);
    public function update($id);
    public function delete($id);
}