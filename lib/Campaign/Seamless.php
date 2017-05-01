<?php

class Seamless
{
    public static function analyze(string $html) : bool
    {
        preg_match_all('/<iframe.+>/', $html, $str);
        for($i=0; $i<count($str); $i++)
        {
            if(count($str[$i]) == 0)
            {
                continue;
            }

            // 全て小文字に変換
            $iframe = strtolower($str[$i][0]);

            // クオートを削除
            $iframe = str_replace("'", "", $iframe);
            $iframe = str_replace('"', "", $iframe);

            // 空白を削除
            $iframe = str_replace("\t", "", $iframe);
            $iframe = str_replace(" ", "", $iframe);
            
            // <iframe width="0" scrolling="no" height="0" frameborder="0" src="" seamless="seamless">
            $rate = 0;
            
            if(strpos($iframe, 'width=0') !== false)
            {
                $rate += 1;
            }
            if(strpos($iframe, 'height=0') !== false)
            {
                $rate += 1;
            }
            if(strpos($iframe, 'scrolling=no') !== false)
            {
                $rate += 1;
            }
            if(strpos($iframe, 'frameborder=0') !== false)
            {
                $rate += 1;
            }
            if(strpos($iframe, 'seamless=seamless') !== false)
            {
                $rate += 4;
            }

            if($rate >= 5)
            {
                return true;
            }
        }

        return false;
    }
}
