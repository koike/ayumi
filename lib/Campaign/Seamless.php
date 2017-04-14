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

        // <div style='width: 1px; height: 1px; position: absolute; left:-500px; top: -500px;'>
        if(preg_match('/<center><iframe.+seamless="seamless"/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
