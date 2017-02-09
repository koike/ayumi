<?php

class Analyze
{
    private $url,
    $html,
    $is_malicious,
    $result,
    $description,
    $gist_url,
    $js_content;
    
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->html = null;
        $this->is_malicious = false;
        $this->result = null;
        $this->description = null;
        $this->gist_url = null;
        $this->js_content = null;
    }
    
    public function analyze(array $response) : bool
    {
        $status = $response['status'];
        $html = $response['body'];
        $this->html = $html;
        
        if($status >= 200 && $status < 400)
        {
            $pd = PseudoDarkleech::analyze($html);
            if($pd)
            {
                $this->description = 'pseudoDarkleech';
            }
            $ei = EITest::analyze($html);
            if($ei)
            {
                $this->description = 'EITest';
            }
            $ei2 = EITest2::analyze($html);
            if($ei2)
            {
                $this->description = 'EITest2';
            }
            $af = Afraidgate::analyze($html, $this->url);
            if($af['is_malicious'])
            {
                $this->description = 'Afraidgate (' . $af['js'] . ')';
                $this->js_content = $af['js_content'];
            }
            $af = $af['is_malicious'];
            $c1 = C1::analyze($html);
            if($c1)
            {
                $this->description = 'C1';
            }
            $c2 = C2::analyze($html);
            if($c2)
            {
                $this->description = 'C2';
            }
            
            if($pd || $ei || $ei2 || $af || $c1 || $c2)
            {
                $this->is_malicious = true;
                return true;
            }
        }
        
        $this->is_malicious = false;
        return false;
    }
    
    public function register_db()
    {
        DB::table('RESULT')
        ->insert
        (
            [
                'url'           =>  $this->url,
                'description'   =>  $this->description,
                'created_at'    =>  date('Y-m-d H:i:s')
            ]
        );

        // ドメインに紐付いてるIPの情報を得る
        $subdomain = parse_url($this->url, PHP_URL_HOST);
        $ip_addr['subdomain'] = gethostbynamel($subdomain);

        // サブドメインの場合はメインドメインの情報も得る
        $element = explode('.', $subdomain);
        if(count($element) >= 3)
        {
            $tld = end($element);
            $domain = $element[count($element)-2] . '.' . $tld;
            $ip_addr['domain'] = gethostbynamel($domain);
        }
        
        // データをgistにPOSTする
        if($this->js_content != null)
        {
            $files =
            [
                "data.html" =>
                [
                    'content'   =>  $this->html . ''
                ],
                'code.js' =>
                [
                    'content'   =>  $this->js_content . ''
                ],
                'ip.json' =>
                [
                    'content'   =>  json_encode($ip_addr) . ''
                ]
            ];
        }
        else
        {
            $files =
            [
                "data.html" =>
                [
                    'content'   =>  $this->html . ''
                ],
                'ip.json' =>
                [
                    'content'   =>  json_encode($ip_addr) . ''
                ]
            ];
        }

        $this->gist_url = Gist::create('[' . $this->description . '] ' . $this->url, false, $files);
        
        DB::table('GIST')
        ->insert
        (
            [
                'url'           =>  $this->url,
                'gist'          =>  $this->gist_url,
                'created_at'    =>  date('Y-m-d H:i:s')
            ]
        );
    }

    public function get_url()
    {
        return $this->url;
    }
    
    public function get_is_malicious()
    {
        return $this->is_malicious;
    }
    
    public function get_gist_url()
    {
        return $this->gist_url;
    }
    
    public function get_description()
    {
        return $this->description;
    }
}