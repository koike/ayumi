<?php

use GuzzleHttp\Client;

class Notificate
{
    public static function slack(Analyze $ayumi)
    {
        if($ayumi->get_url() != null)
        {
            $token = getenv('SLACK_TOKEN');
            if($token != null && $token != '')
            {
                $channel = '#alert';
                $text = '[Compromised (' . $ayumi->get_description() . ')] ' . date('Y-m-d H:i:s') .
                        "\n```\n" .
                        $ayumi->get_url() .
                        "\n```\n\n" .
                        "[Gist]\n" . $ayumi->get_gist_url();
                $url = 'https://slack.com/api/chat.postMessage';
                $data =
                [
                    'token'     =>  $token,
                    'channel'   =>  $channel,
                    'text'      =>  $text,
                    'username'  =>  'ayumi'
                ];
                Notificate::post($url, $data);
            }
        }
    }

    public static function error($no, $str, $file, $line)
    {
        $token = getenv('SLACK_TOKEN');
        if($token != null && $token != '')
        {
            $channel = '#error';
            $text = "[Error (" . $no . ")]\n" .
                    "file:" . $file . " => line:" . $line . "\n" .
                    "```\n" .
                    $str .
                    "\n```";

            $url = 'https://slack.com/api/chat.postMessage';
            $data =
            [
                'token'     =>  $token,
                'channel'   =>  $channel,
                'text'      =>  $text,
                'username'  =>  'ayumi'
            ];
            Notificate::post($url, $data);
        }
    }

    public static function exception(\Exception $e)
    {
        $token = getenv('SLACK_TOKEN');
        if($token != null && $token != '')
        {
            $channel = '#exception';

            ob_start();
            var_dump($e);
            $exception_dump = ob_get_contents();
            ob_end_clean();

            $exception_dump = str_replace('```', '` ` `', $exception_dump);
            $code = $e->getCode();
            $file = $e->getFile();
            $line = $e->getLine();
            $trace = $e->getTraceAsString();
            $message = $e->getMessage();
            $text = "[Exception (" . $code . ")]\n" .
                    "file:" . $file . " => line:" . $line . "\n" .
                    $message . "\n" .
                    "```\n" .
                    $trace .
                    "\n```";

            $url = 'https://slack.com/api/chat.postMessage';
            $data =
            [
                'token'     =>  $token,
                'channel'   =>  $channel,
                'text'      =>  $text,
                'username'  =>  'ayumi'
            ];
            Notificate::post($url, $data);
        }
    }

    public static function shutdown()
    {
        $token = getenv('SLACK_TOKEN');
        if($token != null && $token != '')
        {
            $channel = '#alert';
            $text = "System terminated! Rebooting...";

            $url = 'https://slack.com/api/chat.postMessage';
            $data =
            [
                'token'     =>  $token,
                'channel'   =>  $channel,
                'text'      =>  $text,
                'username'  =>  'ayumi'
            ];
            Notificate::post($url, $data);
        }

        // // 無限に再起動するのを防ぐために一旦スリープする
        // sleep(5 * 60);
        // exec('nohup php ayumi.php > /dev/null 2>&1 &', $arr, $res);
    }

    public static function post($url, $data)
    {
        $client = new Client();
        $res = $client
        ->post
        (
            $url,
            [
                'form_params' => $data
            ]
        );
        
        return $res->getBody()->getContents();
    }
}
