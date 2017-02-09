<?php

class C1
{
    public static function analyze(string $html) : bool
    {
        // /rotation/hists?
        if(preg_match('/<iframe src=[\'|"]https?:\/\/.+\/rotation\/hits?/', $html))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
