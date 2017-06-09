<?php


namespace Phi\HTTP;


class Response
{

    protected $headers = array();
    protected $content = '';


    public function __construct($content = '', array $headers = array())
    {
        $this->content = $content;
        $this->headers = $headers;
    }

    public function addHeader($nameOrHeader = null, $value = null)
    {
        if ($nameOrHeader instanceof Header) {
            $name = $nameOrHeader->getName();
            $value = $nameOrHeader->getValue();
        } else {
            $name = $nameOrHeader;
        }

        $header = new Header($name, $value);
        $this->headers[$name] = $header;
        return $this;
    }


    public function send()
    {

        foreach ($this->headers as $header) {
            $header->send();
        }
        return $this->content;

    }

}