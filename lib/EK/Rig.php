<?php

class Rig
{
    public static function analyze(string $html) : bool
    {
        $rate = 0;

        // biw, ct, br_fl, tuif, oq
        if(strpos($html, 'br_fl=') !== false)
        {
            $rate += 0.5;
        }
        if(strpos($html, 'tuif=') !== false)
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

        if($rate >= 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
