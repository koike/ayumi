<?php

class Seamless
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
        $html = str_replace(' ', '', $html);
        $html = strtolower($html);

        // <center><iframe width="0" scrolling="no" height="0" frameborder="0" src="" seamless="seamless">
        if(preg_match('/<center><iframe width="0"scrolling="no"height="0"frameborder="0"src=".+"seamless="seamless">/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
