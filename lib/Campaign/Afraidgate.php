<?php

class Afraidgate
{
    public static function analyze(string $html, string $url)
    {
        if
        (
            preg_match_all
            (
                '/<script type=\"text\/javascript\" src=\".+\.js\"><\/script>/',
                $html,
                $js_array,
                PREG_SET_ORDER
            )
        )
        {
            foreach($js_array as $js)
            {
                $js = $js[0];
                $js = substr($js, strlen('<script type="text/javascript" src="'));
                $js = substr($js, 0, (-1) * strlen('"></script>'));
                if(preg_match('/^https?:\/\//', $js))
                {
                    $server_host = parse_url($url, PHP_URL_HOST);
                    $host = parse_url($js, PHP_URL_HOST);

                    // JSが同一サーバ上にある場合は無視
                    if($server_host == $host)
                    {
                        return ['is_malicious' => false, 'js' => null, 'content' => null];
                    }

                    // 既に調べていないかデータベースを確認
                    $url_accessed = json_decode
                    (
                        json_encode
                        (
                            DB::table('AFRAID')->where('domain', $host)->get()
                        ),
                        true
                    );
                    if(!empty($url_accessed))
                    {
                        return ['is_malicious' => false, 'js' => null, 'content' => null];
                    }

                    $date = date('Y-m-d H:i:s');
                    DB::table('AFRAID')
                    ->insert
                    (
                        [
                            'domain'        =>  $host,
                            'created_at'    =>  $date
                        ]
                    );

                    $elements = explode('.', $host);
                    if(count($elements) > 2)
                    {
                        $host = $elements[count($elements) - 2] . '.' . $elements[count($elements) - 1];
                    }
                    try
                    {
                        $dns = dns_get_record($host, DNS_NS);
                        for($i=0; $i<count($dns); $i++)
                        {
                            if($dns[$i]['type'] == 'NS')
                            {
                                $ns = $dns[$i]['target'];
                                $elements = explode('.', $ns);
                                if(count($elements) > 2)
                                {
                                    $ns = $elements[count($elements) - 2] . '.' . $elements[count($elements) - 1];
                                }
                                if($ns == 'afraid.org')
                                {
                                    // JSを読み込む
                                    $js_content = null;
                                    
                                    // schemeを含む場合(http://google.com/code.js)
                                    if(preg_match('/^https?:\/\//', $js))
                                    {
                                        $js_content = file_get_contents($js);
                                    }
                                    // schemeを含まない場合(//google.com/code.js)
                                    else if(preg_match('/^\/\//', $js))
                                    {
                                        $js_content = file_get_contents('http:' . $js);
                                    }
                                    // 相対パスの場合(/code.js)
                                    else if(preg_match('/^\//', $js))
                                    {
                                        $js_content = file_get_contents($url . $js);
                                    }
                                    // 相対パスの場合(code.js)
                                    else
                                    {
                                        $js_content = file_get_contents($url . '/' . $js);
                                    }

                                    $rate = 0;
                                    if(preg_match('/style="position:absolute; top:-([0-9]{3,4})px/', $js_content))
                                    {
                                        $rate += 1;
                                    }
                                    if(preg_match('/iframe src="https?:\/\/([a-zA-Z0-9\-_]+)\.([a-zA-Z0-9\-_]+)\.([a-zA-Z0-9]+)/', $js_content))
                                    {
                                        $rate += 1;
                                    }
                                    if($rate >= 1)
                                    {
                                        return ['is_malicious' => true, 'js' => $js, 'content' => $js_content];
                                    }
                                }
                            }
                        }
                    }
                    catch(\Error $e)
                    {
                        //
                    }
                    catch(\Exception $e)
                    {
                        //
                    }
                    catch(\Throwable $t)
                    {
                        //
                    }
                }
            }
        }
        return ['is_malicious' => false, 'js' => null, 'content' => null];
    }
}
