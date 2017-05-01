<?php

class Seamless
{
    public static function analyze(string $html) : bool
    {
        // 改行を削除
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);

        // 空白系を削除
        $html = str_replace("\t", "", $html);
        $html = str_replace(' ', '', $html);

        // クオート系を削除
        $html = str_replace("'", '', $html);
        $html = str_replace('"', '', $html);

        // 全て小文字に変換
        $html = strtolower($html);
        
        // <iframe width="0" scrolling="no" height="0" frameborder="0" src="" seamless="seamless">
        $rate = 0;
        
        if(strpos($html, '<iframe') !== false)
        {
            $rate += 1;
        }
        if(strpos($html, 'width=0') !== false)
        {
            $rate += 1;
        }
        if(strpos($html, 'height=0') !== false)
        {
            $rate += 1;
        }
        if(strpos($html, 'scrolling=no') !== false)
        {
            $rate += 1;
        }
        if(strpos($html, 'frameborder=0') !== false)
        {
            $rate += 1;
        }
        if(strpos($html, 'seamless=seamless') !== false)
        {
            $rate += 4;
        }

        if($rate >= 6)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
