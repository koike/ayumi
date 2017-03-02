<?php

class C5
{
    public static function analyze(string $html) : bool
    {
        // <center><iframe
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
