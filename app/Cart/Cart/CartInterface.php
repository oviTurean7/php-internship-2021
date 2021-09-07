<?php

namespace App\Cart;

interface CartInterface
{
    public function add();
    public function remove();
    public function change();

}