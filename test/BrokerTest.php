<?php

namespace Clarifai_Test;

use Clarifai\Broker\Socket;

class BrokerTest extends \PHPUnit_Framework_TestCase
{
    public function provideBrokerHost()
    {
        return [
            ['http://lazos.me/foo',[],[]],
            ['https://lazos.me/foo',[],[]],
            ['http://lazos.me:8080/foo',[],[]],
            ['https://lazos.me:8080/foo',[],[]],
            ['http://lazos.me/foo?foo=bar',['bop'=>'plop'],[]],
            ['https://lazos.me/foo?foo=bar',['foo'=>'baz','bop'=>'plop'],[]],
        ];
    }

    /**
     * @dataProvider provideBrokerHost
     * @param $url
     * @param $data
     * @param $url
     */
    public function testBrokerHost($url, $data, $expected)
    {
        $broker = new Socket($url, $data);
        $broker->send();
    }
}
