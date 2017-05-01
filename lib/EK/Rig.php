<?php

class Rig
{
    public static function analyze(string $html) : bool
    {
        $rate = 0;

        // q, oq, biw, ct, fix, que, qtuif
        if(strpos($html, 'oq=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'biw=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'ct=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'fix=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'que=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'qtuif=') !== false)
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
