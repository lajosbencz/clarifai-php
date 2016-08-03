<?php

namespace Clarifai\Broker;

use Clarifai\Broker;
use Clarifai\Exception;

class Socket extends Broker
{
    public function send()
    {
        $url = parse_url($this->getUrl());
        $query = [];
        if(isset($url['query'])) {
            parse_str($url['query'], $query);
        }
        $data = $this->getData();
        if($this->isPost()) {
            $data = array_merge($query, $data);
        }
        $data = http_build_query($data);
        $proto = 'tcp';
        $port = 80;
        if($url['scheme'] == 'https') {
            $proto = 'tls';
            $port = 443;
        }
        if(isset($url['port'])) {
            $port = $url['port'];
        }
        $host = $url['host'];
        $path = $url['path'];
        if(isset($url['query'])) {
            $path.= '?'.$url['query'];
        }
        $fp = fsockopen($proto.'://'.$host, $port, $errno, $errstr);
        if($fp === false) {
            throw new Exception($errno, $errstr);
        }
        fputs($fp, "POST $path HTTP/1.1\r\n");
        fputs($fp, "Host: $host\r\n");
        fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
        fputs($fp, "Content-length: ". strlen($data) ."\r\n");
        fputs($fp, "Connection: close\r\n\r\n");
        fputs($fp, $data);
        $result = '';
        while(!feof($fp)) {
            // receive the results of the request
            $result .= fgets($fp, 128);
        }
        fclose($fp);
        $result = explode("\r\n\r\n", $result, 2);
        $header = isset($result[0]) ? $result[0] : '';
        $content = isset($result[1]) ? $result[1] : '';
        return $content;
    }
}