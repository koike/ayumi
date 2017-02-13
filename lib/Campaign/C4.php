<?php

class C4
{
    public static function analyze(string $html) : bool
    {
        // scriptタグでPHPを読み込んでいる
        if(preg_match('/<script.+src=.+\.php.+><\/script>/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
