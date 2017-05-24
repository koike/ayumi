<?php

class EITest
{
    public static function analyze(string $html) : bool
    {
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
