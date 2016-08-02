<?php

namespace Clarifai\Broker;

use Clarifai\Broker;
use Clarifai\Exception;

class Curl extends Broker
{
    public function send()
    {
        $c = curl_init($this->getUrl());
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($c, CURLOPT_POST, $this->isPost());
        if($this->isPost()) {
            curl_setopt($c, CURLOPT_POSTFIELDS, $this->getData());
        }
        $r = curl_exec($c);
        if($r === false) {
            throw new Exception(curl_error($c), curl_errno($c));
        }
        return $r;
    }
}