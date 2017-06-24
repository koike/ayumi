<?php

class Seamless
{
    public static function analyze(string $html) : bool
    {
        // <iframe width="0" scrolling="no" height="0" frameborder="0" src="" seamless="seamless">
        if(preg_match('/<iframe width="0" scrolling="no" height="0" frameborder="0" src=".+" seamless="seamless">/', $html))
        {
            return true;
        }

        // 194.58.40.252/signup1.php
        if(strpos($html, '194.58.40.252/signup1.php') !== false)
        {
            return true;
        }

        return false;
    }
}
