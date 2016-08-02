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
        $fp = fsockopen($host, $port, $errno, $errstr);
        if($fp === false) {
            throw new Exception($errno, $errstr);
        }

    }
}