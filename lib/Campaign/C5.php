<?php

class C5
{
    public static function analyze(string $html) : bool
    {
        // <?php
        if(preg_match('/<\?php/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
