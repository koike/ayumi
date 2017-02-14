<?php

use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Database\Events\StatementPrepared;
use Illuminate\Database\Capsule\Manager as BaseDB;

class DB
{
    protected static $db = null;
    
    public static function __callStatic($method, $args)
    {
        if(static::$db == null)
        {
            static::$db = new BaseDB();
            static::$db->addConnection
            (
                [
                    'driver'    => 'sqlite',
                    'database'  => 'ayumi.db'
                ]
            );

            $dispatcher = new Dispatcher(new Container);
            $dispatcher->listen
            (
                StatementPrepared::class,
                function ($event)
                {
                    $event->statement->setFetchMode(PDO::FETCH_ASSOC);
                }
            );
            static::$db->setEventDispatcher(new Dispatcher(new Container));
            static::$db->setAsGlobal();
        }

        return static::$db->$method(...$args);
    }
}
