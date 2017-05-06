<?php

class Rig
{
    public static function analyze(string $html) : bool
    {
        $rate = 0;

        // q, oq, ct, basket, tuesday, fisher
        if(strpos($html, 'oq=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'ct=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'basket=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'tuesday=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'fisher=') !== false)
        {
            $rate += 0.2;
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
