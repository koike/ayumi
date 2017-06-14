<?php

class Afu
{
    public static function analyze(string $html) : bool
    {
        if(strpos($html, '/afu.php?zoneid=') !== false)
        {
            return true;
        }

        return false;
    }
}
