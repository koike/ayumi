<?php

class FakeChromePopup
{
    public static function analyze(string $html) : bool
    {
        // $rate = 0;

        // // if (!!window.chrome && !!window.chrome.webstore)
        // if(preg_match('/if \(!!window\.chrome && !!window\.chrome\.webstore\)/', $html))
        // {
        //     return true;
        // }

        // // <div id="popup-container" class="popuo-window gc" style="display:none;">
        // if(preg_match('/<div id="popup-container" class="popuo-window gc" style="display:none;">/', $html))
        // {
        //     $rate += 1;
        // }

        // // document.getElementById('popup-container')
        // if(preg_match('/document\.getElementById\(\'popup-container\'\)/', $html))
        // {
        //     $rate += 1;
        // }

        // if($rate >= 2)
        // {
        //     return true;
        // }
        // else
        // {
        //     return false;
        // }

        return false;
    }
}
