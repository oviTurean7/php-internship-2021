<?php

$config = require_once '../config.php';

session_start();

function toggleColumn($columnToSort) {
    if($_SESSION['columns'][$columnToSort] == 'asc')
        $_SESSION['columns'][$columnToSort] = 'desc';
    else
        $_SESSION['columns'][$columnToSort] = 'asc';
}

$columnToSort = '';

if (isset($_REQUEST['sort'])) {
    $columnToSort = $_REQUEST['sort'];
    if(isset($_SESSION['columns'])) {
        toggleColumn($columnToSort);
    }
    else {
        $_SESSION['columns'] = array('price' => 'asc', 'name' => 'asc');
        toggleColumn($columnToSort);
    }
}

header('Location: '.$config['url'].'/products?column='.$_REQUEST['sort'].'&operation='.$_SESSION['columns'][$columnToSort]);

















