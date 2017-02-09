<?php

use GuzzleHttp\Client;
use Guzzle\Http\Client as GuzzleClient;
use Guzzle\Plugin\History\HistoryPlugin;

class Request
{
    public static function get(string $url, $ua = null, $ref = null) : array
    {
        if(!is_string($url) || strlen($url) == 0)
        {
            return
            [
                'status'    =>  400,
                'type'      =>  null,
                'body'      =>  null
            ];
        }

        $ua = 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648)';
        $ref = $url;

        $client = new Client(['verify' => false]);
        try
        {
            $response = $client->request
            (
                'GET',
                $url,
                [
                    'headers'   =>
                    [
                        'User-Agent'    =>  $ua,
                        'Referer'       =>  $ref
                    ],
                    'timeout'   =>  5
                ]
            );

            return
            [
                'status'    =>  $response->getStatusCode(),
                'type'      =>  $response->getHeader('Content-Type'),
                'body'      =>  $response->getBody()
            ];
        }
        catch(\Throwable $t)
        {
            return
            [
                'status'    =>  500,
                'type'      =>  null,
                'body'      =>  null
            ];
        }
        catch(\Exception $e)
        {
            return
            [
                'status'    =>  500,
                'type'      =>  null,
                'body'      =>  null
            ];
        }
    }

    public static function extract_url(string $url) : string
    {
        if(!is_string($url) || strlen($url) == 0)
        {
            return $url;
        }

        // linkisは余計な部分を取り除く
        if(preg_match('/^https?:\/\/linkis\.com\/[a-zA-Z0-9]/', $url))
        {
            if(substr($url, 0, 5) === 'https')
            {
                $extract_url = 'https://' . substr($url, 19);
            }
            else
            {
                $extract_url = 'http://' . substr($url, 18);
            }
            $host = parse_url($extract_url, PHP_URL_HOST);
            if(strpos($host, '.') === false)
            {
                return $url;
            }

            return $extract_url;
        }
        
        $ua = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36';
        $ref = $url;
        try
        {
            $curl = curl_init($url);
            $options =
            [
                CURLOPT_USERAGENT => $ua,
                CURLOPT_TIMEOUT => 5,
                CURLOPT_HTTPGET => true,
                CURLOPT_RETURNTRANSFER => true
            ];
            curl_setopt_array($curl, $options);
            $response = curl_exec($curl);
            $headers = curl_getinfo($curl);
            $extract_url = $headers['redirect_url'];

            if(!preg_match('/^https?:\/\//', $extract_url))
            {
                $domain = parse_url($url, PHP_URL_SCHEME) . '://' . parse_url($url, PHP_URL_HOST);
                $extract_url = $domain . $extract_url;
            }

            $host = parse_url($extract_url, PHP_URL_HOST);
            if(strpos($host, '.') === false)
            {
                return $url;
            }
            return $extract_url;
        }
        catch(\Throwable $t)
        {
            return $url;
        }
        catch(\Exception $e)
        {
            return $url;
        }
    }
}
