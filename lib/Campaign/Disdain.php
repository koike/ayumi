<?php

class Disdain
{
    public static function analyze(string $html) : bool
    {
        $html = str_replace("\r", "", $html);
        $html = str_replace("\n", "", $html);
        $html = str_replace("\t", "", $html);
        $html = str_replace(' ', '', $html);

        if(strpos($html, '</iframe><!DOCTYPE html>') !== false)
        {
            return true;
        }
        
        return false;
    }
}
