<?php


namespace Phi\HTTP;


class Response
{

    /**
     * @var Header[]
     */
    protected $headers = array();

    /**
     * @var string
     */
    protected $content = '';


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

    /**
     * @return Header[]
     */
    public function getHeaders()
    {
        return $this->headers;
    }


    /**
     * @param null $nameOrHeader
     * @param null $value
     * @return $this
     */
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


}