<?php

class HookAds
{
    public static function analyze(string $html) : bool
    {
        // <center><iframe src='URL' frameborder='0' scrolling='no' width='xxx' height='xx'></iframe></center>
        if(preg_match('/<center><iframe src=/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
