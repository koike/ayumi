<?php

class C2
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
        $html = str_replace(' ', '', $html);
        
        // </body><iframe src="hoge" width="極端に小さな値" height="極端に小さな値" style="何か入る可能性がある"></iframe></html>
        if(preg_match('/<\/body><iframe.+<\/iframe><\/html>/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
