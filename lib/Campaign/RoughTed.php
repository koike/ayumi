<?php

class RoughTed
{
    public static function analyze(string $html) : bool
    {
        if
        (
            strpos($html, 'tid=') !== false &&
            strpos($html, 'red=') !== false &&
            strpos($html, 'abt=') !== false &&
            strpos($html, 'v=') !== false
        )
        {
            return true;
        }

        return false;
    }
}
