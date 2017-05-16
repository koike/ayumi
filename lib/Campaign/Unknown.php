<?php

class Unknown
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace(' ', '', $html);
        
        if
        (
            strpos($html, 'functionloadjscssfile(filename,filetype)') !== false &&
            strpos($html, 'filetype=="css"') === false
        )
        {
            return true;
        }

        if(strpos($html, 'Loading,waitasecond') !== false && strpos($html, 'setTimeout(function(){location.href') !== false)
        {
            return true;
        }

        return false;
    }
}
