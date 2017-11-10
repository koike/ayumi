<?php

class PseudoDarkleech
{
    public static function analyze(string $html) : bool
    {
        // $rate = 0;

        // // spanのtopが大きなマイナス値
        // if(preg_match('/<span style="position:absolute; top:-([0-9]{3,4})px/', $html))
        // {
        //     $rate += 1;
        // }
        
        // // // iframeのsrcが小文字.大文字.大文字からなるドメイン
        // // if(preg_match('/iframe src="https?:\/\/([a-zA-Z0-9\-_]+)\.([a-zA-Z0-9\-_]+)\.([a-zA-Z0-9]+)/', $html))
        // // {
        // //     $rate += 1;
        // // }

        // if($rate >= 1)
        // {
        //     return true;
        // }
        // else
        {
            return false;
        }
    }
}
