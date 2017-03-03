<?php

class Nebula
{
    public static function analyze(string $html) : bool
    {
        // URLパラメータの値が56文字で, base64文字列
        if(preg_match('/\/\?[0-9a-zA-Z_\-]{1,30}=[0-9a-zA-Z_\-]{56}["|\']/', $html, $result))
        {
            $base64_str = explode('=', $result[0])[1];
            $base64_str = str_replace('"', '', $base64_str);
            $base64_str = str_replace("'", '', $base64_str);
            if(base64_decode($base64_str))
            {
                return true;
            }
        }
        return false;
    }
}
