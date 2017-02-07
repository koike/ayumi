<?php

use GuzzleHttp\Client;

class Gist
{
    public static function create(string $description, bool $public, array $files)
    {
        $gist =
        [
            'files'         =>  $files,
            'description'   =>  $description,
            'public'        =>  $public
        ];

        $res = Gist::post('https://api.github.com/gists', $gist);
        $body = $res->getBody()->getContents();
        $body = json_decode($body, true);
        $url = $body['url'] ?? null;
        if($url != null)
        {
            $exp = explode('/', $url);
            $end = end($exp);
            $url = 'https://gist.github.com/anonymous/' . $end;
        }

        return $url;
    }

    private static function post($url, $data)
    {
        $client = new Client();
        $res = $client
        ->post
        (
            $url,
            [
                'json' => $data
            ]
        );
        
        return $res;
    }
}
