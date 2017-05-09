<?php

class Unknown
{
    public static function analyze(string $html) : bool
    {
        if
        (
            strpos($html, 'function loadjscssfile(filename, filetype)') !== false &&
            strpos($html, 'filetype=="css"') === false
        )
        {
            return true;
        }

        return false;
    }
}
