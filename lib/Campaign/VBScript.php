<?php

class VBScript
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
        $html = str_replace(' ', '', $html);
        
        // <script language="VBScript
        if(preg_match('/language=["|\']vbscript/', strtolower($html)))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
