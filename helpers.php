<?php
global $config;

$config = require_once 'config.php';

function basePath()
{
    return __DIR__;
}

function appPath()
{
    return __DIR__.'/app';
}

function styleUrl($filename)
{
    global $config;

    return $config['url'].'/styles/'.$filename.'?v=' . rand();
}

function scriptUrl($filename)
{
    global $config;

    return $config['url'].'/scripts/'.$filename;
}
