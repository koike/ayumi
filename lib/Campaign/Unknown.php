<?php

class Unknown
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
        $html = str_replace(' ', '', $html);

        // <iframe style='hidden' src='EK URL' width='0' height='0'></iframe>
        if(preg_match('/<iframestyle=\'hidden\'src=\'http:\/\/.+\'width=\'0\'height=\'0\'><\/iframe>/', $html, $result))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
