<?php

global $config;


$config = require_once 'config.php';

function basePath()
{
    return __DIR__;
}

function publicPath()
{
    return __DIR__ . '/public';
}

function dataPath()
{
    return __DIR__ . '/data';
}

function appPath()
{
    return __DIR__ . '/app';
}

function uploadsPath()
{
    return __DIR__ . '/public/uploads';
}

function oopPath()
{
    return __DIR__ . '/oop';
}

function databasePath()
{
    return __DIR__ . '/public/database';
}

function styleUrl($filename)
{
    global $config;
//    var_dump($config);
//    exit();

    return $config['url'] . '/styles/' . $filename;
}

function assetUrl($filename)
{
    global $config;
//    var_dump($config);
//    exit();

    return $config['url'] . '/assets/' . $filename;
}


function scriptUrl($filename)
{
    global $config;

    return $config['url'] . '/scripts/' . $filename;
}

