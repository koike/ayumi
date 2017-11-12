<?php

class Disdain
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);

        // if(strpos($html, '</iframe><!DOCTYPE html>') !== false)
        if(preg_match('/<iframe src="http:\/\/.+" width="1" height="1" style="position:absolute;left:-1px;"><\/iframe>/', $html))
        {
            return true;
        }
        
        return false;
    }
}
