<?php

$composer = 'composer install';
exec($composer, $arr, $ret);

if(!file_exists('ayumi.db'))
{
    $sql = 'sqlite3 ayumi.db < setup.sql';
    exec($sql, $arr, $ret);
}

echo PHP_EOL. 'Install Success!' . PHP_EOL;
