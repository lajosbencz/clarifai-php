<?php

namespace Clarifai;

abstract class Broker implements BrokerInterface
{
    /** @var string */
    protected $_url;

    /** @var array */
    protected $_data = [];

    /** @var bool */
    protected $_post = true;

    /**
     * Broker constructor.
     * @param null $url
     * @param array $data
     */
    public function __construct($url=null, $data=[])
    {
        $this->setUrl($url);
        $this->setData($data);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->_url = $url;
        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isPost()
    {
        return $this->_post;
    }

    /**
     * @return $this
     */
    public function setPost()
    {
        $this->_post = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return !$this->_post;
    }

    /**
     * @return $this
     */
    public function setGet()
    {
        $this->_post = false;
        return $this;
    }

    /**
     * @return string
     */
    abstract public function send();
}