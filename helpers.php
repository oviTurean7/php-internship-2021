<?php

global $config;

$config = require_once 'config.php';

function basePath()
{
    return __DIR__;
}

function appPath()
{
    return __DIR__ . '/app';
}

function styleUrl($filename)
{
    global $config;

    return $config['url'] . '/styles/' . $filename . '?v=' . rand();
}

function scriptUrl($filename)
{
    global $config;

    return $config['url'] . '/scripts/' . $filename;
}

function getDbConfig()
{
    return require 'config-db.php';
}

function getConnection()
{
    $config_db = getDbConfig();

    if (!is_array($config_db) || empty($config_db) || empty($config_db['database'])) {
        exit('NO DATABASE ERROR');
    }

    $database_info = $config_db['database'];

    $conn = new mysqli($database_info['server'], $database_info['user'], $database_info['password'], $database_info['name']);
    if (!$conn) {
        die('Connection failed:' . $conn->connect_error);
    }
    return $conn;
}