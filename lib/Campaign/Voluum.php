<?php

class Voluum
{
    public static function analyze(string $html) : bool
    {
        if(strpos($html, '/voluum/') !== false)
        {
            return true;
        }

        return false;
    }
}
