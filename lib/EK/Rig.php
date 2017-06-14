<?php

class Rig
{
    public static function analyze(string $html) : bool
    {
        $rate = 0;

        // if(preg_match("/x[HX3].+Q[cdM].{3}[ab]R/", $html))
        // {
        //     return true;
        // }

        if(strpos($html, 'eparamaters') !== false)
        {
            $rate += 1;
        }
        if(strpos($html, 'ahr_fl') !== false)
        {
            $rate += 1;
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
