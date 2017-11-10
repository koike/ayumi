<?php

class Small
{
    public static function analyze(string $html) : bool
    {
        return false;

        // $html = str_replace("\r", '', $html);
        // $html = str_replace("\n", '', $html);
        // $html = str_replace(' ', '', $html);
        // $html = str_replace("\t", '', $html);

        // if(strpos($html, 'position:absolute;') !== false)
        // {
        //     $rate += 1;
        // }
        // if(strpos($html, "style='width:368px;") !== false)
        // {
        //     $rate += 1;
        // }
        // if(strpos($html, '</iframe></i>') !== false)
        // {
        //     $rate += 1;
        // }
        // if(strpos($html, "<divstatus='visible'") !== false)
        // {
        //     $rate += 1;
        // }

        // if($rate > 3)
        // {
        //     return true;
        // }

        // return false;
    }
}
