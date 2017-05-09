<?php

class Small
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);

        if(preg_match('/<iframe.+id=\'.+\'.+src=\'http:\/\/.+\?\'.+<\/iframe>.+<\/div>/', $html))
        {
            return true;
        }

        return false;
    }
}
