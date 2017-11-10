<?php

class Seamless
{
    public static function analyze(string $html) : bool
    {
        // // <iframe width="0" scrolling="no" height="0" frameborder="0" src="" seamless="seamless">
        // if(preg_match('/<iframe width="0" scrolling="no" height="0" frameborder="0" src=".+" seamless="seamless">/', $html))
        // {
        //     return true;
        // }

        // // 194.58.40.252/signup1.php
        // if(strpos($html, '194.58.40.252/signup1.php') !== false)
        // {
        //     return true;
        // }

        // $rate = 0;
        // if(strpos($html, 'eval(function(p,a,c,k,e,r)') !== false)
        // {
        //     $rate += 1;
        // }
        // if(strpos($html, '$(2).7(3(){$("8").9();') !== false)
        // {
        //     $rate += 1;
        // }
        // if(strpos($html, 'href|type|POST|data') !== false)
        // {
        //     $rate += 1;
        // }
        // if(strpos($html, 'tz|referrer|he|success|eval') !== false)
        // {
        //     $rate += 1;
        // }
        // if($rate >= 3)
        // {
        //     return true;
        // }
        
        return false;
    }
}
