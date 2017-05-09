<?php

class Unknown
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
        $html = str_replace(' ', '', $html);

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
