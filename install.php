<?php

$composer = 'composer install';
exec($composer, $arr, $ret);

if(!file_exists('tomori.db'))
{
    $sql = 'sqlite3 tomori.db < setup.sql';
    exec($sql, $arr, $ret);
}

echo PHP_EOL. 'Install Success!' . PHP_EOL;
