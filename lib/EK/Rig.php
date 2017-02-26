<?php

class Rig
{
    public static function analyze(string $html) : bool
    {
        $rate = 0;
        $flag = 0;

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
            $flag++;
        }
        if(strpos($html, 'q=') !== false)
        {
            $rate += 0.2;
            $flag++;
        }
        if(strpos($html, 'word=') !== false)
        {
            $rate += 0.4;
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

        if($rate >= 1 || $flag === 2)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
