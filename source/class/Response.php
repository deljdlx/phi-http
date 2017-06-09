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


}