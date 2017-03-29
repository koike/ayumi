<?php

class HookAds
{
    public static function analyze(string $html) : bool
    {
        // <center><iframe src='URL' frameborder='0' scrolling='no' width='xxx' height='xx'></iframe></center>
        if(preg_match('/<center><iframe src=\'http:\/\/.+\' frameborder=\'0\' scrolling=\'no\' width=\'[0-9]{2,4}\' height=\'[0-9]{2,4}\'><\/iframe><\/center>/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
