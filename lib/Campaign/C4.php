<?php

class C4
{
    public static function analyze(string $html) : bool
    {
        // .biz/1
        if(preg_match('/<iframe src=[\'|"]https?:\/\/.+\.biz\/1/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
