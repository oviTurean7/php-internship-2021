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
    return require_once 'config-db.php';
}

function getConnection()
{
    $configDB = getDbConfig();

    $conn = new \mysqli($configDB['database']['server'], $configDB['database']['user'], $configDB['database']['password'], $configDB['database']['name']);
    if (!$conn) {
        die('Connection failed:' . $conn->connect_error);
    }
    return $conn;
}