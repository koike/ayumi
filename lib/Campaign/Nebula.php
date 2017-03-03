<?php

class Nebula
{
    public static function analyze(string $html) : bool
    {
        // <div style='width: 1px; height: 1px; position: absolute; left:-500px; top: -500px;'>
        if(preg_match('/<div style=\'width: 1px; height: 1px; position: absolute; left:-500px; top: -500px;\'>/', $html, $result))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
