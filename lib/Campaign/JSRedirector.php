<?php

class JSRedirector
{
    public static function analyze(string $html)
    {
        $html = str_replace("\n", "", $html);
        $html = str_replace('"\r', "", $html);

        // <script type='text/javascript'
        if(preg_match("/<script type='text\/javascript' src='http:\/\/.{1,150}<\/body>/", $html, $match))
        {
            $match = $match[0];
            $js_url = explode("'", explode("src='", $match)[1])[0];

            $js = Request::get($js_url);
            if($js['status'] >= 200 && $js['status'] < 400)
            {
                $js = $js['body'];

                // document.write('<script src="http://www.example.com/m84MRmlBh.js"><\x2fscript>');
                $js = str_replace("\n", "", $js);
                $js = str_replace('"\r', "", $js);

                if(preg_match("/document\.write\('<script src=\"http:\/\/.{1,100}\">/", $js))
                {
                    return ['is_malicious' => true, 'js' => $js_url, 'content' => $js];
                }
            }
        }

        return ['is_malicious' => false, 'js' => null, 'content' => null];
    }
}
