<?php

class EITest
{
    public static function analyze(string $html) : bool
    {
        $rate = 0;
        
        // <body> </body>
        if(preg_match('/<body> <\/body>/', $html))
        {
            $rate += 1;
        }

        // iframeという文字列を持つ変数
        if(preg_match('/var ([a-zA-Z]{4,8}) = "iframe"/', $html))
        {
            $rate += 1;
        }

        // http://小文字.大文字.大文字
        if(preg_match('/https?:\/\/([a-z0-9\-_]+)\.([a-zA-Z0-9\-_]+)\.([a-zA-Z0-9]+)/', $html))
        {
            $rate += 0.5;
        }

        // biw, ct, br_fl, tuif, oq
        if(strpos($html, 'biw=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'ct=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'br_fl=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'tuif=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'oq=') !== false)
        {
            $rate += 0.2;
        }

        if(strpos($html, 'sourceid=') !== false)
        {
            $rate += 0.5;
        }
        if(strpos($html, 'aqs=') !== false)
        {
            $rate += 0.5;
        }

        if(strpos($html, 'QMvXcJ') !== false)
        {
            $rate += 1;
        }
        if(strpos($html, 'WrwE0q') !== false)
        {
            $rate += 1;
        }
        if(strpos($html, 'fPrfJxzFGMSUb-nJDa9') !== false)
        {
            $rate += 1;
        }

        if($rate >= 2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
