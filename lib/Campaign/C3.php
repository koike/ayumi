<?php

class C3
{
    public static function analyze(string $html) : bool
    {
        // iframe -> tcp/18001
        if(preg_match('/<iframe src=[\'|"]https?:\/\/.+:18001/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
