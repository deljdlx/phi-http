<?php


namespace Phi\HTTP;


class Message
{

    /**
     * @var Header[]
     */
    protected $headers = array();
    protected $body = '';
    protected $data;


    public function __construct()
    {

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



    /**
     * @param $content
     * @return $this
     */
    public function setBody($content)
    {
      $this->body = $content;
      return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getBodyData()
    {
        if($this->data === null) {
            parse_str($this->getBody(), $this->data);
        }

        return $this->data;

    }


}