<?php

session_start();

if(isset($_SESSION['cartProducts'])) {
    print_r($_SESSION['cartProducts']);
    exit();
}
