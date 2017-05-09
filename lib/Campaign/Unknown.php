<?php

class Unknown
{
    public static function analyze(string $html) : bool
    {
        // function loadjscssfile(filename, filetype)
        if(preg_match('/function loadjscssfile\(filename, filetype\)/', $html, $result))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
