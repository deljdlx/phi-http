<?php


namespace Phi\HTTP;


class Response extends Message
{



    /**
     * @var string
     */
    protected $content = '';


    /**
     * Response constructor.
     * @param string $content
     * @param Header[] $headers
     */
    public function __construct($content = '', array $headers = array())
    {
        $this->content = $content;
        $this->headers = $headers;
    }


    /**
     * @param $content
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }



}