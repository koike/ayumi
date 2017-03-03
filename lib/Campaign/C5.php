<?php

class C5
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
        $html = str_replace(' ', '', $html);

        // 先頭がフツーではない場合
        // 誤検知多いのは想定内
        if(preg_match('/^<html/i', $html))
        {
            return false;
        }
        if(preg_match('/^<!/i', $html))
        {
            return false;
        }

        return true;
    }
}
