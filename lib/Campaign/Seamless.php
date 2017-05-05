<?php

class Seamless
{
    public static function analyze(string $html) : bool
    {
        // <iframe width="0" scrolling="no" height="0" frameborder="0" src="" seamless="seamless">
        if(preg_match('/<iframe width="0" scrolling="no" height="0" frameborder="0" src=".+" seamless="seamless">/', $html, $result))
        {
            return true;
        }

        return false;
    }
}
