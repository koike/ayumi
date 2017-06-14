<?php

class Unknown
{
    public static function analyze(string $html) : bool
    {
        if(strpos($html, '/afu.php?zoneid=') !== false)
        {
            return true;
        }
        if(strpos($html, 'src="/popunder.php"') !== false)
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
