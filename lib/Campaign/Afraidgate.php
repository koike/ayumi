<?php

class Afraidgate
{
    public static function analyze(string $html, string $url) : bool
    {
        if
        (
            preg_match_all
            (
                '/<script type=\"text\/javascript\" src=\"[!-~]+\.js\"><\/script>/',
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
                        return false;
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
                        return false;
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
                                return true;
                            }
                        }
                    }
                }
            }
        }
        return false;
    }
}
