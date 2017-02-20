<?php

class C1
{
    public static function analyze(string $html) : bool
    {
        // hits?
        if(preg_match('/<iframe src=[\'|"]https?:\/\/.+hits\?/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
