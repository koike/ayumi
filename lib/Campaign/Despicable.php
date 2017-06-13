<?php

class Despicable
{
    public static function analyze(string $html) : bool
    {
        $rate = 0;

        if(strpos($html, 'key=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'post=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'websiteid=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'quality=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'categoryid=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'formfactorname=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'campaignid=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'campaignname=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'screenresolution=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'impressionid=') !== false)
        {
            $rate += 0.2;
        }
        if(strpos($html, 'bid=') !== false)
        {
            $rate += 0.2;
        }

        if($rate >= 1)
        {
            return true;
        }

        return false;
    }
}
