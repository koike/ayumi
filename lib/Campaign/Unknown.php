<?php

class Unknown
{
    public static function analyze(string $html) : bool
    {
        if(strpos($html, 'afu.php') !== false)
        {
            return true;
        }
        if(strpos($html, 'popunder.php') !== false)
        {
            return true;
        }
        if(strpos($html, '/banners/uaps') !== false)
        {
            return true;
        }

        return false;
    }
}
