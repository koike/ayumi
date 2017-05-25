<?php

class EITest
{
    public static function analyze(string $html) : bool
    {
        if(strpos($html, '<script>function GetWindowHeight(){var a=0;return"number"==typeof _Top.window.innerHeight?a=_Top.window.innerHeight:_Top.document.documentElement&&_Top.document.documentElement.clientHeight?') !== false)
        {
            return true;
        }

        $rate = 0;
        
        // iframeという文字列を持つ変数
        if(preg_match('/var ([a-zA-Z]{4,8}) = "iframe"/', $html))
        {
            $rate += 2;
        }

        // frameBorder = "0"
        if(preg_match('/frameBorder = "0"/', $html))
        {
            $rate += 0.5;
        }

        // style.border = "0px"
        if(preg_match('/style\.border = "0px"/', $html))
        {
            $rate += 0.5;
        }

        // setAttribute("frameBorder", "0")
        if(preg_match('/setAttribute\("frameBorder", "0"\)/', $html))
        {
            $rate += 0.5;
        }

        if($rate > 2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
