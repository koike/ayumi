<?php

class ProtJS
{
    public static function analyze(string $html) : bool
    {
        if(strpos($html, '/protJS/') !== false)
        {
            return true;
        }

        return false;
    }
}
