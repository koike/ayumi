<?php

require_once 'lib/loader.php';

use Dotenv\Dotenv;

function error_handler($no, $str, $file, $line)
{
    Notificate::error($no, $str, $file, $line);
    exit(-1);
}

function exception_handler($e)
{
    Notificate::exception($e);
    exit(-1);
}

function shutdown_handler()
{
    Notificate::shutdown();
}

set_error_handler('error_handler');
set_exception_handler('exception_handler');
register_shutdown_function('shutdown_handler');

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

while(true)
{
    // csvを取得する
    $url = 'http://s3.amazonaws.com/alexa-static/top-1m.csv.zip';
    $data = file_get_contents($url);
    file_put_contents('top-1m.csv.zip', $data);

    $zip = new ZipArchive;
    if ($zip->open('top-1m.csv.zip') === true)
    {
        $zip->extractTo(__DIR__);
        $zip->close();
    }
    unlink('top-1m.csv.zip');

    // csvを読み込む
    $file = new SplFileObject('top-1m.csv');
    $file->setFlags(SplFileObject::READ_CSV);
    $urls = [];
    foreach ($file as $line)
    {
        if(count($line) == 2)
        {
            $url = 'http://' . $line[1];
            array_push($urls, $url);
        }
    }

    $urls = array_reverse($urls);
    $c = count($urls);
    for($i=0; $i<$c; $i++)
    {
        $url = $urls[$i];

        $date = date('Y-m-d H:i:s');
        DB::table('URL')
        ->insert
        (
            [
                'url'           =>  $url,
                'created_at'    =>  $date
            ]
        );

        $response = Request::get($url);
        $ayumi = new Analyze($url);
        $ayumi->analyze($response);
        
        if($ayumi->get_is_mallicious())
        {
            $ayumi->register_db();
            Notificate::slack($ayumi);
            echo '[*] (' . ($c-$i) . ') ' . $url . PHP_EOL;
        }
        else
        {
            echo '[-] (' . ($c-$i) . ') ' . $url . PHP_EOL;
        }
    }
}
