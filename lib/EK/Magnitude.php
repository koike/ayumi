<?php

class Magnitude
{
    public static function analyze(string $html) : bool
    {
        if(preg_match('/http:\/\/(?![a-z]+\.)[a-z0-9]{7,22}\.[a-z]{5,9}\.(?!com|org|net)[a-z]{2,7}\/(?![a-z]+$)[a-z0-9]{8,128}$/', $html))
        {
            return true;
        }
        
        // domoney4it.com
        if(strpos($html, 'domoney4it.com') !== false)
        {
            return true;
        }

        return false;
    }
}
