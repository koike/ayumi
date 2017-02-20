<?php

require_once 'vendor/autoload.php';

// require_once /lib/*.php
foreach(glob(__DIR__ . '/*.php') as $file)
{
    if(is_file($file))
    {
        require_once $file;
    }
}

// require_once /lib/Campaign/*.php
foreach(glob(__DIR__ . '/Campaign/*.php') as $file)
{
    if(is_file($file))
    {
        require_once $file;
    }
}

// require_once /lib/EK/*.php
foreach(glob(__DIR__ . '/EK/*.php') as $file)
{
    if(is_file($file))
    {
        require_once $file;
    }
}
