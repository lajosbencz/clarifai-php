<?php

namespace Clarifai;

interface BrokerInterface
{
    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url);

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data);

    /**
     * @return $this
     */
    public function setPost();

    /**
     * @return $this
     */
    public function setGet();

    /**
     * @return string
     * @throws Exception
     */
    public function send();
}